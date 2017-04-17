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
    ]
];
