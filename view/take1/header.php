<?php
    $logoUrl = $app->url->create("");
    
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">

        <link rel="stylesheet" href="css/style.min.css">

        <title><?= $title ?></title>
    </head>
<body>
    <div class="wrap-all">
        <div class="outer-wrap outer-wrap-header">
            <div class="inner-wrap inner-wrap-header">
                <div class="row">
                    <header class="site-header">
                        <a class="site-logo" href="<?= $logoUrl ?>">Tobias Almroth</a>
                    </header>
                </div>                   
            </div>
        </div>
