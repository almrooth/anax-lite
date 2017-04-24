<main class="site-main site-profile">

    <h1>Logga in</h1>
    
    <form action="<?= $app->url->create('validate') ?>" method="POST">
        <div>
            <label>Användarnamn: </label>
            <input type="text" name="uname">
        </div>
        <div>
            <label>Lösenord: </label>
            <input type="password" name="pass">
        </div>
        <button type="submit">Logga in</button>
    </form>

    <a href="<?= $app->url->create('register') ?>">Registrera dig</a>

</main>