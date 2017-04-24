<main class="site-main site-profile">

    <h1>Redigera profil</h1>

    <p><?= $status ?></p>
    
    <form action="<?= $app->url->create('handle_profile_edit') ?>" method="POST">
        <div>
            <label>Info: </label><br>
            <textarea name="info"><?= $info ?></textarea>
        </div>
        
        <button type="submit">Uppdatera</button>
    </form>

</main>