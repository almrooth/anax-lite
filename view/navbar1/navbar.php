<?php

$navbar = [
    "config" => [
        "navbar-class" => "navbar"
    ],
    "items" => [
        "home" => [
            "text" => "Hem",
            "route" => "",
        ],
        "report" => [
            "text" => "Redovisning",
            "route" => "report",
        ],
        "about" => [
            "text" => "Om sidan",
            "route" => "about",
        ],
    ],
];

// Loop through all items of $navbar and add to $html
$navbarClass = $navbar["config"]["navbar-class"];
$html = "<nav class=\"$navbarClass\">";
$html .= "<ul>";
foreach ($navbar["items"] as $item) {
    $text = $item["text"];
    $url = $app->url->create($item["route"]);
    $lastRoute = $app->router->getLastRoute();

    $html .= "<li>";
    // Check if current route and url route matches and if so add class active
    if ($lastRoute == $item["route"]) {
        $html .= "<a class=\"active\" href=\"$url\">$text</a>";
    } else {
        $html .= "<a href=\"$url\">$text</a>";
    }
    $html .= "</li>";
}
$html .= "</ul>";
$html .= "</nav>";

?>

            <div class="outer-wrap outer-wrap-navbar">
                <div class="inner-wrap inner-wrap-navbar">
                    <div class="row">
                        <?= $html ?>
                    </div>
                </div>
            </div>
