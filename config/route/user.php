<?php
$app->router->add("login", function () use ($app) {

    $app->session->start();

    if ($app->session->has("uname")) {
        $app->response->redirect($app->url->create("profile"));
    }

    $status = $app->session->get("status");

    $app->view->add("take1/header", ["title" => "Login"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("user/login", ["status" => $status]);
    $app->view->add("take1/footer");

    $app->session->delete("status");

    $app->response->setBody([$app->view, "render"])->send();
});

$app->router->add("validate", function () use ($app) {

    $app->session->start();
    $app->db->connect();

    $uname = htmlentities($app->request->getPost("uname"));
    $pass = htmlentities($app->request->getPost("pass"));

    if ($uname != null && $pass != null) {
        if ($app->db->exists($uname)) {
            $pass_hash = $app->db->getHash($uname);

            if (password_verify($pass, $pass_hash)) {
                $app->session->set("uname", $uname);
                $app->cookie->set("kakan", "Användarnamnet är $uname.");
                
                $app->session->set("utype", $app->db->getType($uname));

                $app->response->redirect("profile");
            } else {
                $app->session->set("status", "Användarnamn eller lösenord felaktigt!");
                $app->response->redirect("login");
            }
        } else {
            $app->session->set("status", "Användare finns inte!");
            $app->response->redirect("login");
        }
    } else {
        $app->session->set("status", "Ett fält är blankt!");
        $app->response->redirect("login");
    } 
});

$app->router->add("register", function () use ($app) {

    $app->session->start();
    $app->db->connect();

    $status = $app->session->get("status");

    $app->view->add("take1/header", ["title" => "Sign up"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("user/register", ["status" => $status]);
    $app->view->add("take1/footer");

    $app->session->delete("status");

    $app->response->setBody([$app->view, "render"])->send();
});

$app->router->add("handle_register", function () use ($app) {

    $app->session->start();
    $app->db->connect();

    $uname = htmlentities($app->request->getPost("uname"));
    $pass = htmlentities($app->request->getPost("pass"));
    $pass2 = htmlentities($app->request->getPost("pass2"));

    if ($app->db->exists($uname) == false) {
        if ($pass != $pass2) {
            $app->session->set("status", "Lösenorden matchar inte!");
            $app->response->redirect("register");
        } else {
            $crypt_pass = password_hash($pass, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users VALUES (?, ?, ?, ?)";
            $app->db->execute($sql, [$uname, $crypt_pass, "user", ""]);

            $app->session->set("status", "Användare '$uname' skapad!");
            $app->response->redirect("login");
        }
    } else {
        $app->session->set("status", "Användarnamnet är upptaget!");
        $app->response->redirect("register");
    }
});

$app->router->add("profile", function () use ($app) {

    $app->session->start();

    if (!$app->session->has("uname")) {
        $app->response->redirect("login");
    }

    $uname = $app->session->get("uname");

    $app->db->connect();
    $info = $app->db->getInfo($uname);
    
    if ($app->cookie->has("kakan")) {
        $cookie = $app->cookie->get("kakan");
    }

    $app->view->add("take1/header", ["title" => "Profil"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("user/profile", ["uname" => $uname, "info" => $info, "cookie" => $cookie]);
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])->send();
});

$app->router->add("profile_edit", function () use ($app) {

    $app->session->start();

    if (!$app->session->has("uname")) {
        $app->response->redirect("login");
    }

    $uname = $app->session->get("uname");
    $status = $app->session->get("status");

    $app->db->connect();
    $info = $app->db->getInfo($uname);    

    $app->view->add("take1/header", ["title" => "Uppdatera profil"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("user/profile_edit", ["uname" => $uname, "info" => $info, "status" => $status]);
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])->send();
});

$app->router->add("handle_profile_edit", function () use ($app) {

    $app->session->start();
    $app->db->connect();

    $uname = $app->session->get("uname");
    $info = htmlentities($app->request->getPost("info"));

    $app->db->changeInfo($uname, $info);
    $app->session->set("status", "Profil updaterad!");

    $app->response->redirect("profile_edit");
});

$app->router->add("logout", function () use ($app) {

    $app->session->start();

    if ($app->session->has("uname")) {
        $uname = $app->session->get("uname");
        $app->session->destroy();
    } else {
        $app->response->redirect("login");
    }

    $app->view->add("take1/header", ["title" => "Utloggad"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("user/logout", ["uname" => $uname]);
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])->send();
});

$app->router->add("pass_change", function () use ($app) {

    $app->session->start();

    if (!$app->session->has("uname")) {
        $app->response->redirect("login");
    }

    $status = ($app->session->has("status")) ? $app->session->get("status") : "";

    $app->view->add("take1/header", ["title" => "Utloggad"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("user/pass_change", ["status" => $status]);
    $app->view->add("take1/footer");

    $app->session->delete("status");

    $app->response->setBody([$app->view, "render"])->send();
});

$app->router->add("handle_pass_change", function () use ($app) {

    $app->session->start();
    $app->db->connect();

    $uname = $app->session->get("uname");
    $pass = htmlentities($app->request->getPost("pass"));
    $new_pass = htmlentities($app->request->getPost("new_pass"));
    $new_pass_2 = htmlentities($app->request->getPost("new_pass_2"));

    if ($pass != null && $new_pass != null && $new_pass_2 != null) {
        if (password_verify($pass, $app->db->getHash($uname))) {
            if ($new_pass == $new_pass_2) {
                $crypt_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                $app->db->changePassword($uname, $crypt_pass);
                $app->session->set("status", "Lösenordet ändrat!");
                $app->response->redirect("pass_change");
            } else {
                $app->session->set("status", "Löesnorden matchar inte!");
                $app->response->redirect("pass_change");
            }
        } else {
            $app->session->set("status", "Nuvarande lösenord felaktigt!");
            $app->response->redirect("pass_change");
        }
    } else {
        $app->session->set("status", "Alla fält måste vara ifyllda!");
        $app->response->redirect("pass_change");
    }
});
