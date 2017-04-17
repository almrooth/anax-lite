<?php

if (!$app->session->has("num")) {
    $app->session->set("num", 42);
} 

$number = $app->session->get("num");

$incrementUrl = $app->url->create("session/increment");
$decrementUrl = $app->url->create("session/decrement");
$statusUrl = $app->url->create("session/status");
$dumpUrl = $app->url->create("session/dump");
$destroyUrl = $app->url->create("session/destroy");

?>

<div class="outer-wrap outer-wrap-home">
    <div class="inner-wrap inner-wrap-home">
        <div class="row">
            <main class="site-main site-session">

                <h1>Session test page</h1>

                <nav class=".session-nav">
                    <a href="<?= $incrementUrl ?>">Increment</a>
                    <a href="<?= $decrementUrl ?>">Decrese</a>
                    <a href="<?= $statusUrl ?>">Status</a>
                    <a href="<?= $dumpUrl ?>">Dump</a>
                    <a href="<?= $destroyUrl ?>">Destroy</a>
                </nav>

                <p><?= $number ?><p>

            </main>
        </div>
    </div>
</div>