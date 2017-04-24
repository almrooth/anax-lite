<div class="outer-wrap outer-wrap-admin">
    <div class="inner-wrap inner-wrap-admin">
        <main class="site-main site-admin">

            <h1>Byt lösenord</h1>

            <p><?= $status ?></p>

            <p>Användare: <?= $user->username ?></p>

            <form action="handle_admin_edit_pass" method="POST">
                <input type="hidden" name="uname" value="<?= $user->username ?>">
                <div>
                    <label>Nytt lösenord: </label>
                    <input type="password" name="new_pass">
                </div>
                <div>
                    <label>Nytt lösenord igen: </label>
                    <input type="password" name="new_pass_2">
                </div>
                <button type="submit">Uppdatera</button> 
            </form>

        </main>
    </div>
</div>


