<?php

namespace Talm\App;

/**
 * An App class to wrap the resources of the framework.
 */
class App
{
    public function redirect($url)
    {
        $this->response->redirect($this->url->create($url));
    }

    public function renderPage($page, $title, $data = null)
    {
        $this->view->add("take1/header", ["title" => "$title"]);
        $this->view->add("navbar2/navbar");
        $this->view->add("$page", $data);
        $this->view->add("take1/footer");

        $this->response->setBody([$this->view, "render"])->send();
    }

    public function esc($text)
    {
        return htmlentities($text);
    }
}
