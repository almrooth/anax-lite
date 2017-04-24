<main class="site-main site-profile">

    <h1>Byt lösenord</h1>

    <p><?= $status ?></p>
    
    <form action="<?= $app->url->create('handle_pass_change') ?>" method="POST">
        <div>
            <label>Nuvarande lösenord: </label>
            <input type="text" name="pass">
        </div>
        <div>
            <label>Nytt lösenord: </label>
            <input type="password" name="new_pass">
        </div>
        <div>
            <label>Nytt lösenord igen: </label>
            <input type="password" name="new_pass_2">
        </div>
        <button type="submit">Byt lösenord</button>
    </form>

</main>