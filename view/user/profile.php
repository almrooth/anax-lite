<?php
$html = "";
if ($app->session->get("utype") == "admin") {
    $link = $app->url->create("admin");
    $html .= "<a href='$link'>Admininstratörsportal</a>";
}
?>  

<main class="site-main site-profile">

    <h1><?= $uname ?>'s profil</h1>

    <h2>Om <?= $uname ?></h2>
    <p><?= $info ?></p>

    <p><strong>Lagrad cookie: </strong><?= $cookie ?></p>

    <p><a href="<?= $app->url->create('profile_edit') ?>">Uppdatera profil</a></p>
    <p><a href="<?= $app->url->create('pass_change') ?>">Byt lösenord</a></p>
    <p><?= $html ?></p>
    <p><a href="<?= $app->url->create('logout') ?>">Logga ut</a></p>
</main>