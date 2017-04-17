<?php

$app->router->add("calendar", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Kalender"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("calendar/calendar");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])->send();
});
