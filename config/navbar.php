<?php
/**
 * Config for navbar
 */
return [
    "config" => [
            "navbar-class" => "navbar"
    ],
    "items" => [
        "home" => [
            "text" => "Hem",
            "route" => "",
            "items" => []
        ],
        "session" => [
            "text" => "Session",
            "route" => "session",
            "items" => []
        ],
        "calendar" => [
            "text" => "Kalender",
            "route" => "calendar",
            "items" => []
        ],
        "report" => [
            "text" => "Redovisning",
            "route" => "report",
            "items" => []
        ],
        "about" => [
            "text" => "Om sidan",
            "route" => "about",
            "items" => []
        ],
        "text" => [
            "text" => "TextFilter",
            "route" => "content/test",
            "items" => []
        ],
        "pages" => [
            "text" => "Sidor",
            "route" => "content/pages",
            "items" => []
        ],
        "blog" => [
            "text" => "Blogg",
            "route" => "content/blog",
            "items" => []
        ],
        "login" => [
            "text" => "Intranät",
            "route" => "login",
            "items" => []
        ],
        "webshop" => [
            "text" => "Webshop",
            "route" => "webshop/products",
            "items" => []
        ],
    ]
];
