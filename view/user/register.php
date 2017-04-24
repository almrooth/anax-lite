<main class="site-main site-profile">

    <h1>Registrera</h1>

    <form action="<?= $app->url->create('handle_register') ?>" method="POST">
        <div>
            <label>Användarnamn: </label>
            <input type="text" name="uname">
        </div>
        <div>
            <label>Lösenord: </label>
            <input type="password" name="pass">
        </div>
        <div>
            <label>Lösenord igen: </label>
            <input type="password" name="pass2">
        </div>
        <button type="submit">Registrera</button>
    </form>


</main>