<?php

?>
<div class="outer-wrap outer-wrap-content">
    <div class="inner-wrap inner-wrap-content">
        <main class="site-main site-content">

            <h1>Blogg</h1>
                
            <?php 
            foreach ($res as $row) :
                $url = $app->url->create("content/blog/" . esc($row->slug));
            ?>

            <section>
                <header>
                    <h1><a href="<?= $url ?>"><?= esc($row->title) ?></a></h1>
                    <p>Publicerat: <?= esc($row->published) ?></p>
                </header>

                <?php
                if (!empty($row->filter)) {
                    echo $app->textformat->format($row->data, $row->filter);
                } else {
                    echo $row->data;
                }
                ?>

            </section>

            <?php 
            endforeach; 
            ?>
            </table>

        </main>
    </div>
</div>