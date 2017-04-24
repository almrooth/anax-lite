<div class="outer-wrap outer-wrap-admin">
    <div class="inner-wrap inner-wrap-admin">
        <main class="site-main site-admin">

            <h1>Redigera användare <?= $user->username ?></h1>

            <p><?= $status ?></p>

            <form action="handle_admin_edit" method="POST">
                <input type="hidden" name="uname" value="<?= $user->username ?>">
                <div>
                    <label>Användartyp: </label>
                    <select name="utype">
                        <option value="admin" <?php echo ($user->type == 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="user" <?php echo ($user->type == 'user') ? 'selected' : '' ?>>User</option>
                    </select>
                </div>
                <div>
                    <label>Info: </label><br>
                    <textarea name="info"><?= $user->info ?></textarea>
                </div>
                <button type="submit">Uppdatera</button> 
            </form>

            <p><a href="<?= $app->url->create('admin_edit_pass') .'?uname=' . $user->username ?>">Byt lösenord</a></p>

        </main>
    </div>
</div>


