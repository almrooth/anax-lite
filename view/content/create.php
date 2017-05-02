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

            <h1>Skapa innehåll</h1>

            <?= $status ?>

            <form action="" method="POST">
                <div>
                    <label>Title:</label>
                    <input type="text" name="title" value=""></input>
                </div>
                
                <button type="submit" name="create">Create content</button>

            </form>

        </main>
    </div>
</div>