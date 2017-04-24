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

$defaultRoute = "?route=sort&";

function orderby2($column, $route)
{
    $asc = mergeQueryString(["orderby" => $column, "order" => "asc"], $route);
    $desc = mergeQueryString(["orderby" => $column, "order" => "desc"], $route);
    
    return <<<EOD
<span class="orderby">
<a href="$asc">&darr;</a>
<a href="$desc">&uarr;</a>
</span>
EOD;
}

function mergeQueryString($options, $prepend = "?")
{
    // Parse querystring into array
    $query = [];
    parse_str($_SERVER["QUERY_STRING"], $query);

    // Merge query string with new options
    $query = array_merge($query, $options);

    // Build and return the modified querystring as url
    return $prepend . http_build_query($query);
}

?>

<div class="outer-wrap outer-wrap-admin">
    <div class="inner-wrap inner-wrap-admin">
        <main class="site-main site-admin">

            <h1>Administratörsportal</h1>

            <p>Samtliga användare</p>

            <table>
                <tr>
                    <th>Användanamn <?= orderby2("username", $defaultRoute) ?></th>
                    <th>Användartyp <?= orderby2("type", $defaultRoute) ?></th>
                </tr>
                <?= $html ?>
            </table>

            <p>
                Sida:
                <?php for ($i = 1; $i <= $max; $i++) : ?>
                    <a href="<?= mergeQueryString(["page" => $i], $defaultRoute) ?>"><?= $i ?></a> 
                <?php endfor; ?>
            </p>

        </main>
    </div>
</div>


