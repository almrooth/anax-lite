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

            <h1>Webshop - product catalogue</h1>

            <table class="ws-table">
                <tr>
                    <th>Image</th>
                    <th>Product name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th></th>
                    <th></th>
                </tr>
                
            <?php foreach ($res as $row) :
                $edit_url = $app->url->create("webshop/products/edit?id=" . $row->id);
                $del_url = $app->url->create("webshop/products/delete?id=" . $row->id);
            ?>

                <tr>
                    <td><img src="../img/<?= $row->image ?>" class="prod-img"/></td>
                    <td><?= $row->name ?></td>
                    <td><?= $row->category ?></td>
                    <td><?= $row->status ?></td>
                    <td><?= $row->items ?></td>
                    <td><?= $row->price ?></td>
                    <td><a href="<?= $edit_url ?>">Edit</a></td>
                    <td><a href="<?= $del_url ?>">Delete</a></td>
                </tr>

            <?php endforeach; ?>
            </table>

        </main>
    </div>
</div>