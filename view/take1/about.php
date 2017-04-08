<?php
    $url = $app->url->create("status");
?>

<div class="outer-wrap outer-wrap-about">
    <div class="inner-wrap inner-wrap-about">
        <div class="row">
            <main class="site-main site-about">

                <h1>Om sidan</h1>
                <p>Den här sidan är skapad inom ramen för kursen "OOPHP" vid programmet "Webbprogrammering" vid Blekinge Tekniska Högskola.</p>
                <p>Kursen är en fortsättningskurs i PHP med fokus på objekt orienterad PHP-programmering, databasen MYSQL och ramverk.</p>
                <p>Under kursens gång bygger vi ett eget ramverk i PHP och använder det till den här sidan.</p>

                <p>Här nedan finns några länkar till smått och gott om ramverket och annat inom kursen:</p>

                <a href="<?= $url ?>">Systemstatus</a><br>
                <a href="https://github.com/almrooth/anax-lite">Ramverket på GitHub</a>

                <div class="about-logo-area">

                    <p>powered by</p>

                    <div class="about-logos">
                        <img src="img/GitHub_Logo.png">
                        <img src="img/logo-mysql-170x115.png">
                        <img src="img/PHP-logo.svg">
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
