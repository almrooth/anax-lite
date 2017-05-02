<?php
 
?>
<div class="outer-wrap outer-wrap-content">
    <div class="inner-wrap inner-wrap-content">
        <main class="site-main site-content">

            <h1>Radera innehåll</h1>

            <?= $status ?>

            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= esc($res->id) ?>"></input>
                <div>
                    <label>Title:</label>
                    <input type="text" name="title" value="<?= esc($res->title) ?>" readonly/>
                </div>
                
                <button type="submit" name="delete">Delete content</button>

            </form>

        </main>
    </div>
</div>