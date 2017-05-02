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

            <h1>Sidinnehåll</h1>

            <table>
                <tr>
                    <th>Id</th>
                    <th>Titel</th>
                    <th>Typ</th>
                    <th>Publicerat</th>
                    <th>Skapat</th>
                    <th>Uppdaterat</th>
                    <th>Raderat</th>
                    <th>Åtgärder</th>
                </tr>
                
            <?php 
            foreach ($res as $row) :
                $edit_url = $app->url->create("content/admin/edit?id=" . $row->id);
                $delete_url = $app->url->create("content/admin/delete?id=" . $row->id);
            ?>

                <tr>
                    <td><?= $row->id ?></td>
                    <td><?= $row->title ?></td>
                    <td><?= $row->type ?></td>
                    <td><?= $row->published ?></td>
                    <td><?= $row->created ?></td>
                    <td><?= $row->updated ?></td>
                    <td><?= $row->deleted ?></td>
                    <td><a href="<?= $edit_url ?>">Redigera</a></td>
                    <td><a href="<?= $delete_url ?>">Radera</a></td>
                </tr>

            <?php 
            endforeach; 
            ?>
            </table>

        </main>
    </div>
</div>