<div class="outer-wrap outer-wrap-admin">
    <div class="inner-wrap inner-wrap-admin">
        <main class="site-main site-admin">

            <h1>Lägg till ny användare</h1>

            <p><?= $status ?></p>

            <form action="handle_admin_add" method="POST">
                <div>
                    <label>Användarnamn: </label>
                    <input type="text" name="uname">
                </div>
                <div>
                    <label>Användartyp: </label>
                    <select name="utype">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div>
                    <label>Info: </label><br>
                    <textarea name="info"></textarea>
                </div>
                <div>
                    <label>Lösenord: </label>
                    <input type="password" name="pass">
                </div>
                <div>
                    <label>Lösenord igen: </label>
                    <input type="password" name="pass_2">
                </div>
                <button type="submit">Lägg till</button> 
            </form>

        </main>
    </div>
</div>


