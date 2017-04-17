<?php
$app->router->add("session", function () use ($app) {
    $app->session->start();

    $app->view->add("take1/header", ["title" => "Session"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("session/session");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])->send();
});

$app->router->add("session/increment", function () use ($app) {
    $app->session->start();    
    $app->session->set("num", $app->session->get("num") + 1);
    header("Location: ../session");
});

$app->router->add("session/decrement", function () use ($app) {
    $app->session->start();    
    $app->session->set("num", $app->session->get("num") - 1);
    header("Location: ../session");
});

$app->router->add("session/status", function () use ($app) {
    $app->session->start();

    $data = [
        "Session Id" => session_id(),
        "Session name" => session_name(),
        "Session status" => session_status(),     
        "Session cache expire" => session_cache_expire()   
    ];

    $app->response->sendJson($data);
});

$app->router->add("session/dump", function () use ($app) {
    $app->session->start();

    $app->view->add("take1/header", ["title" => "Session"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("session/dump");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])->send();
});

$app->router->add("session/destroy", function () use ($app) {
    $app->session->start();
    $app->session->destroy();    
    header("Location: dump");
});
