<?php

?>
<div class="outer-wrap outer-wrap-content">
    <div class="inner-wrap inner-wrap-content">
        <main class="site-main site-content">

            <h1><?= esc($res->title) ?></h1>

            <?php
            if (!empty($res->filter)) {
                echo $app->textformat->format($res->data, $res->filter);
            } else {
                echo $res->data;
            }
            
            ?>

        </main>
    </div>
</div>