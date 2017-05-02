<?php

$app->router->add("content/test", function () use ($app) {

    $app->renderPage("content/test", "test");
});

$app->router->add("content/admin/**", function () use ($app) {

    $app->session->start();
    if (!$app->session->has("uname")) {
        $app->redirect("login");
    }
    
});

$app->router->add("content/admin/show-all", function () use ($app) {
    $title = "Show all content";

    $app->db->connect();
    $sql = "SELECT * FROM content;";
    $res = $app->db->executeFetchAll($sql);

    $app->renderPage("content/show-all", $title, ["res" => $res]);
});

$app->router->add("content/admin", function () use ($app) {
    $title = "Admin content";

    $app->db->connect();
    $sql = "SELECT * FROM content;";
    $res = $app->db->executeFetchAll($sql);

    $app->renderPage("content/admin", $title, ["res" => $res]);
});

$app->router->add("content/admin/edit", function () use ($app) {
    $title = "Edit content";
    $id = htmlentities($app->request->getGet("id"));

    $status = "";

    if (array_key_exists("delete", $_POST)) {
        $app->redirect("content/admin/delete?id=" . $id);
    }

    if (array_key_exists("save", $_POST)) {
        $params = [
            $app->request->getPost("title"),
            $app->request->getPost("path"),
            $app->request->getPost("slug"),
            $app->request->getPost("data"),
            $app->request->getPost("type"),
            $app->request->getPost("filter"),
            $app->request->getPost("publish"),
            $id
        ];

        foreach ($params as $key => $value) {
            if (empty($value)) {
                $params[$key] = null;
            }
        }

        if (empty($params[2])) {
            $params[2] = slugify($params[0]);
        }

        $verified = false;
        while (!$verified) {
            $app->db->connect();
            $sql = "SELECT * FROM content WHERE slug=?;";
            $slugs = $app->db->executeFetchAll($sql, [$params[2]]);
            
            if (!empty($slugs)) {
                $params[2] .= "-pad";
            } else {
                $verified = true;
            }
        }   
        
        $app->db->connect();
        $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=?, updated=NOW() WHERE id=?;";
        $app->db->execute($sql, $params);
        $app->redirect("content/admin");
    }

    $app->db->connect();
    $sql = "SELECT * FROM content WHERE id = ?;";
    $res = $app->db->executeFetchAll($sql, [$id]);

    $app->renderPage("content/edit", $title, ["res" => $res[0], "status" => $status]);
}); 

$app->router->add("content/admin/create", function () use ($app) {
    $title = "Create content";
    
    $status = "";

    if (array_key_exists("create", $_POST)) {
        $params = [
            $app->request->getPost("title"),
        ];

        $app->db->connect();
        $sql = "INSERT INTO content (title) VALUES (?);";
        $app->db->execute($sql, $params);
        $id = $app->db->lastInsertId();
        $app->redirect("content/admin/edit?id=" . $id);
    }


    $app->renderPage("content/create", $title, ["status" => $status]);
});

$app->router->add("content/admin/delete", function () use ($app) {
    $title = "Delete content";
    $id = htmlentities($app->request->getGet("id"));
    
    $status = "";

    if (array_key_exists("delete", $_POST)) {
        $del_id = $app->request->getPost("id");
        $app->db->connect();
        $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
        $app->db->execute($sql, [$del_id]);
        $app->redirect("content/admin");
    }

    $app->db->connect();
    $sql = "SELECT id, title FROM content WHERE id=?;";
    $res = $app->db->executeFetchAll($sql, [$id]);

    $app->renderPage("content/delete", $title, ["res" => $res[0], "status" => $status]);
});

$app->router->add("content/pages", function () use ($app) {
    $title = "View pages";
    
    $status = "";

    $app->db->connect();
    $sql = <<<EOD
SELECT 
    *,
    CASE 
        WHEN (deleted <= NOW()) THEN "deleted"
        WHEN (published <= NOW()) THEN "published"
        ELSE "created"
    END AS status
FROM content
WHERE type=?
;
EOD;
    $res = $app->db->executeFetchAll($sql, ["page"]);

    $app->renderPage("content/pages", $title, ["res" => $res, "status" => $status]);
});

$app->router->add("content/page", function () use ($app) {
    $title = "404";
    $app->renderPage("default/404", $title, []);
});

$app->router->add("content/page/{path}", function ($path) use ($app) {
    $app->db->connect();
    $sql = "SELECT * FROM content WHERE path=? AND type=? AND (deleted is NULL OR deleted > NOW()) AND published <= NOW();";
    $res = $app->db->executeFetchAll($sql, [$path, "page"]);

    if (empty($res)) {
        $title = "404";
        $app->renderPage("default/404", $title, []);
    } else {
        $title = $res[0]->title;
        $app->renderPage("content/page", $title, ["res" => $res[0]]);
    }    
});

$app->router->add("content/blog", function () use ($app) {
       $title = "View blog";

       $app->db->connect();
       $sql = "SELECT * FROM content WHERE type=? AND (published <= NOW()) ORDER BY published DESC;";
       $res = $app->db->executeFetchAll($sql, ["post"]);

       $app->renderPage("content/blog", $title, ["res" => $res]);
});

$app->router->add("content/blog/{slug}", function ($slug) use ($app) {
    $app->db->connect();
    $sql = "SELECT * FROM content WHERE slug=? AND type=? AND (deleted is NULL OR deleted > NOW()) AND published <= NOW();";
    $res = $app->db->executeFetchAll($sql, [$slug, "post"]);

    if (empty($res)) {
        $title = "404";
        $app->renderPage("default/404", $title, []);
    } else {
        $title = $res[0]->title;
        $app->renderPage("content/post", $title, ["res" => $res[0]]);
    }    
});
