<?php

?>
<div class="outer-wrap outer-wrap-content">
    <div class="inner-wrap inner-wrap-content">
        <main class="site-main site-content">

            <nav class="admin-nav">
                <ul>
                    <li><a href="<?= $app->url->create('webshop/products') ?>">Products</a></li>
                    <li><a href="<?= $app->url->create('webshop/products/add') ?>">Add product</a></li>
                </ul>
            </nav>

            <h1>Webshop - edit product</h1>

            <form method="POST" action="">
                <input type="hidden" name="prod_id" value="<?= esc($res->id) ?>"></input>
                <div>
                    <label>Name: </label>
                    <input type="text" name="prod_name" value="<?= esc($res->name) ?>"></input>
                </div>
                <div>
                    <label>Category: </label>
                    <input type="text" name="prod_category" value="<?= esc($res->category) ?>"></input>
                </div>
                <div>
                    <label>Description: </label>
                    <textarea name="prod_description"><?= esc($res->description) ?></textarea>
                </div>
                <div>
                    <label>Image: </label>
                    <input type="text" name="prod_image" value="<?= esc($res->image) ?>"></input>
                </div>
                <div>
                    <label>Price: </label>
                    <input type="number" name="prod_price" value="<?= esc($res->price) ?>"></input>
                </div>
                <div>
                    <label>In stock: </label>
                    <input type="number" name="prod_items" value="<?= esc($res->items) ?>"></input>
                </div>
                <button type="submit">Save</button>
                <button type="reset">Reset</button>
            </form>

            <?= $status ?>

        </main>
    </div>
</div>
