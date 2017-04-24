<?php

$html = "";
foreach ($users as $user) {
    $edit_link = $app->url->create("admin_edit") . "?uname=$user->username";
    $del_link = $app->url->create("admin_delete") . "?uname=$user->username";

    $html .= "<tr>";
    $html .= "<td>$user->username</td>";
    $html .= "<td>$user->type</td>";
    $html .= "<td><a href='$edit_link'>Redigera</a></td>";
    $html .= "<td><a href='$del_link'>Radera</a></td>";
    $html .= "</tr>";
}    

?>

<div class="outer-wrap outer-wrap-admin">
    <div class="inner-wrap inner-wrap-admin">
        <main class="site-main site-admin">

            <h1>Sök användare</h1>

            <form method="POST">
                <div>
                    <label>Användare (% som wildcard): </label>
                    <input type="search" name="searchString">
                </div>
                <button type="submit">Sök</button>
            </form>

            <h2>Resultat</h2>
            <table>
                <tr>
                    <th>Användanamn</th>
                    <th>Användartyp</th>
                </tr>
                <?= $html ?>
            </table>

        </main>
    </div>
</div>


