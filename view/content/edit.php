<?php
 
?>
<div class="outer-wrap outer-wrap-content">
    <div class="inner-wrap inner-wrap-content">
        <main class="site-main site-content">

            <nav class="admin-nav">
                <ul>
                    <li><a href="<?= $app->url->create('content/admin') ?>">Hem</a></li>
                    <li><a href="<?= $app->url->create('content/admin/show-all') ?>">Visa allt</a></li>
                    <li><a href="<?= $app->url->create('content/admin/create') ?>">Lägg till innehåll</a></li>
                    
                </ul>
            </nav>

            <h1>Redigera</h1>

            <?= $status ?>

            <form action="" method="POST">
                <div>
                    <label>Titel:</label>
                    <input type="text" name="title" value="<?= esc($res->title) ?>"></input>
                </div>
                <div>
                    <label>Path:</label>
                    <input type="text" name="path" value="<?= esc($res->path) ?>"></input>
                </div>
                <div>
                    <label>Slug:</label>
                    <input type="text" name="slug" value="<?= esc($res->slug) ?>"></input>
                </div>
                <div>
                    <label>Typ (page, post, block):</label>
                    <input type="text" name="type" value="<?= esc($res->type) ?>"></input>
                </div>
                <div>
                    <label>Text:</label>
                    <textarea name="data"><?= esc($res->data) ?></textarea>
                </div>
                <div>
                    <label>Filter (nl2br, bbcode, link, markdown):</label>
                    <input type="text" name="filter" value="<?= esc($res->filter) ?>"></input>
                </div>
                <div>
                    <label>Publicerat (ex. 2017-05-01 12:00:00):</label>
                    <input type="text" name="publish" value="<?= esc($res->published) ?>"></input>
                </div>
                <button type="submit" name="save">Save</button>
                <button type="reset">Reset</button>
                <button type="submit" name="delete">Delete</button>
            </form>

        </main>
    </div>
</div>