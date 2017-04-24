<?php
$app->router->add("admin", function () use ($app) {

    $app->session->start();

    if ($app->session->get("utype") != "admin") {
        $app->response->redirect($app->url->create("profile"));
    }

    $route = htmlentities($app->request->getGet("route"));

    $app->db->connect();

    $hits = 5;
    
    $sql = "SELECT COUNT(username) AS max FROM users";
    $max = $app->db->executeFetchAll($sql);
    $max = ceil($max[0]->max / $hits);
    
    $page = htmlentities($app->request->getGet("page", 1));
    if (!(is_numeric($hits) && $page > 0 && $page <= $max)) {
        die("Ej giligt värde på page!");
    }
    $offset = $hits * ($page - 1);

    if ($route == "sort") {
        $columns = ["username", "type"];
        $orders = ["asc", "desc"];

        $orderBy = htmlentities($app->request->getGet("orderBy")) ?: "username";
        $order = htmlentities($app->request->getGet("order")) ?: "asc";

        if (!in_array($orderBy, $columns) && in_array($order, $orders)) {
            die("Ej giltiga värden för sortering!");
        }

        $sql = "SELECT * FROM users ORDER BY $orderBy $order LIMIT $hits OFFSET $offset";
        $users = $app->db->executeFetchAll($sql);
    } else {
        $sql = "SELECT * FROM users LIMIT $hits OFFSET $offset";
        $users = $app->db->executeFetchAll($sql);
    }

    $app->view->add("take1/header", ["title" => "Login"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin/nav");
    $app->view->add("admin/admin", ["users" => $users, "max" => $max]);
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])->send();
});

$app->router->add("admin_search", function () use ($app) {

    $app->session->start();

    if ($app->session->get("utype") != "admin") {
        $app->response->redirect($app->url->create("profile"));
    }

    $searchString = htmlentities($app->request->getPost("searchString"));

    $app->db->connect();
    $sql = "SELECT * FROM users WHERE username LIKE ?";
    $users = $app->db->executeFetchAll($sql, [$searchString]);

    $app->view->add("take1/header", ["title" => "Sök användare"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin/nav");
    $app->view->add("admin/search", ["users" => $users]);
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])->send();
});

$app->router->add("admin_edit", function () use ($app) {

    $app->session->start();

    if ($app->session->get("utype") != "admin") {
        $app->response->redirect($app->url->create("profile"));
    }
    $status = $app->session->get("status");

    $uname = htmlentities($app->request->getGet("uname"));
    
    $app->db->connect();
    $sql = "SELECT * FROM users WHERE username=?";
    $user = $app->db->executeFetchAll($sql, [$uname])[0];

    $app->view->add("take1/header", ["title" => "Redigera användare"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin/nav");
    $app->view->add("admin/edit", ["user" => $user, "status" => $status]);
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])->send();
});

$app->router->add("handle_admin_edit", function () use ($app) {

    $app->session->start();
    $app->session->delete("status");

    if ($app->session->get("utype") != "admin") {
        $app->response->redirect($app->url->create("profile"));
    }

    $uname = htmlentities($app->request->getPost("uname"));
    $utype = htmlentities($app->request->getPost("utype"));
    $info = htmlentities($app->request->getPost("info"));

    $app->db->connect();
    $sql = "UPDATE users SET type=?, info=? WHERE username=?";
    $app->db->execute($sql, [$utype, $info, $uname]);
    $status = "Användare uppdaterad!";

    $app->session->set("status", $status);

    $app->response->redirect("admin");
});

$app->router->add("admin_edit_pass", function () use ($app) {

    $app->session->start();

    if ($app->session->get("utype") != "admin") {
        $app->response->redirect($app->url->create("profile"));
    }
    $status = $app->session->get("status");

    $uname = htmlentities($app->request->getGet("uname"));
    
    $app->db->connect();
    $sql = "SELECT * FROM users WHERE username=?";
    $user = $app->db->executeFetchAll($sql, [$uname])[0];

    $app->view->add("take1/header", ["title" => "Ändra lösenord"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin/nav");
    $app->view->add("admin/edit_pass", ["user" => $user, "status" => $status]);
    $app->view->add("take1/footer");

    $app->session->delete("status");

    $app->response->setBody([$app->view, "render"])->send();
});

$app->router->add("handle_admin_edit_pass", function () use ($app) {

    $app->session->start();
    $app->session->delete("status");

    if ($app->session->get("utype") != "admin") {
        $app->response->redirect($app->url->create("profile"));
    }

    $uname = htmlentities($app->request->getPost("uname"));
    $new_pass = htmlentities($app->request->getPost("new_pass"));
    $new_pass_2 = htmlentities($app->request->getPost("new_pass_2"));

    $app->db->connect();

    if ($new_pass == $new_pass_2) {
        if ($new_pass != null) {
            $pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password=? WHERE username=?";
            $app->db->execute($sql, [$pass, $uname]);
            $status = "Lösenord ändrat!";
        } else {
            $status = "Lösenord får ej vara tomma!";
        }
    } else {
        $status = "Lösenorden matchar inte!";
    }

    $app->session->set("status", $status);

    $app->response->redirect("admin_edit_pass?uname=$uname");
});

$app->router->add("admin_add_user", function () use ($app) {

    $app->session->start();

    if ($app->session->get("utype") != "admin") {
        $app->response->redirect($app->url->create("profile"));
    }

    $status = $app->session->get("status");

    $app->view->add("take1/header", ["title" => "Lägg till användare"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin/nav");
    $app->view->add("admin/add_user", ["status" => $status]);
    $app->view->add("take1/footer");

    $app->session->delete("status");

    $app->response->setBody([$app->view, "render"])->send();
});

$app->router->add("handle_admin_add", function () use ($app) {

    $app->session->start();
    $app->session->delete("status");

    if ($app->session->get("utype") != "admin") {
        $app->response->redirect($app->url->create("profile"));
    }

    $uname = htmlentities($app->request->getPost("uname"));
    $utype = htmlentities($app->request->getPost("utype"));
    $info = htmlentities($app->request->getPost("info"));
    $pass = htmlentities($app->request->getPost("pass"));
    $pass_2 = htmlentities($app->request->getPost("pass_2"));

    $app->db->connect();

    if ($uname != null) {
        if ($pass == $pass_2) {
            if ($pass != null) {
                $crypt_pass = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users VALUES (?, ?, ?, ?)";
                $app->db->execute($sql, [$uname, $crypt_pass, $utype, $info]);
                $status = "Ny användare skapad.";
            } else {
                $status = "Lösenord får ej vara tomma!";
            }
        } else {
            $status = "Lösenorden matchar inte!";
        }
    } else {
        $status = "Användanamnet får ej vara blankt!";
    }

    $app->session->set("status", $status);

    $app->response->redirect("admin_add_user");
});

$app->router->add("admin_delete", function () use ($app) {

    $app->session->start();

    if ($app->session->get("utype") != "admin") {
        $app->response->redirect($app->url->create("profile"));
    }

    $uname = htmlentities($app->request->getGet("uname"));

    $app->db->connect();

    $sql = "DELETE FROM users WHERE username=?";
    $app->db->execute($sql, [$uname]);

    $app->response->redirect("admin");
});
