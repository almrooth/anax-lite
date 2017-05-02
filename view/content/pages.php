<?php

?>
<div class="outer-wrap outer-wrap-content">
    <div class="inner-wrap inner-wrap-content">
        <main class="site-main site-content">

            <h1>Sidöversikt</h1>

            <table>
                <tr>
                    <th>Id</th>
                    <th>Titel</th>
                    <th>Typ</th>
                    <th>Status</th>
                    <th>Publicerad</th>
                    <th>Raderad</th>
                </tr>
                
            <?php 
            foreach ($res as $row) :
                $url = $app->url->create("content/page/" . $row->path);

            ?>

                <tr>
                    <td><?= $row->id ?></td>
                    <td><a href="<?= $url ?>"><?= $row->title ?></a></td>
                    <td><?= $row->type ?></td>
                    <td><?= $row->status ?></td>
                    <td><?= $row->published ?></td>
                    <td><?= $row->deleted ?></td>
                </tr>

            <?php 
            endforeach; 
            ?>
            </table>

        </main>
    </div>
</div>