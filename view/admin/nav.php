<div class="outer-wrap outer-wrap-admin">
    <div class="inner-wrap inner-wrap-admin">
        <nav class="admin-nav">
            <ul>
                <li><a href="<?= $app->url->create('admin') ?>">Visa användare</a></li>
                <li><a href="<?= $app->url->create('admin_search') ?>">Sök användare</a></li>
                <li><a href="<?= $app->url->create('admin_add_user') ?>">Lägg till användare</a></li>
                <li><a href="<?= $app->url->create('logout') ?>">Logga ut</a></li>
            </ul>
        </nav>
    </div>
</div>
