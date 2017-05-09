<?php

$app->router->add("webshop/**", function () use ($app) {

    $app->session->start();
    if (!$app->session->has("uname")) {
        $app->redirect("login");
    }
});

$app->router->add("webshop/products", function () use ($app) {

    $title = "Webshop";
    $res = $app->webshop->getProductCat();
    
    $app->renderPage("webshop/products", $title, ["res" => $res]);
});

$app->router->add("webshop/products/add", function () use ($app) {

    $title = "Webshop";
    
    if (array_key_exists("prod_name", $_POST)) {
        $app->webshop->addProduct($app->esc($app->request->getPost("prod_name")));
        $app->redirect("webshop/products/edit?id=" . $app->webshop->getLastId());
    }

    $app->renderPage("webshop/prod-add", $title);
});

$app->router->add("webshop/products/delete", function () use ($app) {

    $res = $app->webshop->deleteProduct($app->esc($app->request->getGet("id")));
    
    $app->redirect("webshop/products");
});

$app->router->add("webshop/products/edit", function () use ($app) {

    $title = "Webshop";
    $status = "";

    if (array_key_exists("prod_id", $_POST)) {
        $params = [
            $app->request->getPost("prod_id"),
            $app->request->getPost("prod_name"),
            $app->request->getPost("prod_category"),
            $app->request->getPost("prod_description"),
            $app->request->getPost("prod_image"),
            $app->request->getPost("prod_price"),
            $app->request->getPost("prod_items")
        ];
        $app->webshop->editProduct($params);
        $status = "Product updated!";
    }

    $res = $app->webshop->getProduct($app->esc($app->request->getGet("id")));
    
    $app->renderPage("webshop/prod-edit", $title, ["res" => $res, "status" => $status]);
});
