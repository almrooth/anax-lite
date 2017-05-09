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

            <h1>Webshop - Add product</h1>

            <form method="POST" action="">
                <div>
                    <label>Product name: </label>
                    <input type="text" name="prod_name"></input>
                </div>
                <button type="submit">Add product</button>
            </form>

        </main>
    </div>
</div>