<?php

$orig_nl2br = <<<EOD
Det här ett textstycke för att visa på formatering enligt filtret "nl2br".
Det filtret gör om nya rader till br-taggar.
Så här.
Och så här.
EOD;

$nl2br = $app->textformat->format($orig_nl2br, "nl2br");

$orig_bbcode = <<<EOD
Här kör vi ett stycke som formaterar bbcode. Vi tar lite hjälp av nl2br för radbrytningar.
[b]bold[/b]
[i]italic[/i]
[u]underlined[/u]
[url=http://dbwebb.se]en länk till dbwebb.se[/url]
EOD;

$bbcode = $app->textformat->format($orig_bbcode, "nl2br,bbcode");

$orig_link = <<<EOD
Här gör vi en länk "klickbar"... 
http://dbwebb.se
EOD;

$link = $app->textformat->format($orig_link, "nl2br, link");

$orig_markdown = <<<EOD
Som sista variant kör vi lite *markdown* som vi **stylar** på några olika sätt.

En lista kan vara bra att ha:

* Grej 1
* Grej 2

Och en länk är aldrig fel: [dbwebb.se](http://dbwebb.se)
EOD;

$markdown = $app->textformat->format($orig_markdown, "markdown");
?>

<div class="outer-wrap outer-wrap-content">
    <div class="inner-wrap inner-wrap-content">
        <main class="site-main site-content">

            <h1>Testsida för textformatering</h1>

            <h2>nl2br</h2>
            <p>Oformaterat:</p>
            <p><?= $orig_nl2br ?></p>
            <p>Formaterat:</p>
            <?= $nl2br ?>

            <h2>bbcode</h2>
            <p>Oformaterat:</p>
            <p><?= $orig_bbcode ?></p>
            <p>Formaterat:</p>
            <?= $bbcode ?>

            <h2>link</h2>
            <p>Oformaterat:</p>
            <p><?= $orig_link ?></p>
            <p>Formaterat:</p>
            <?= $link ?>

            <h2>markdown</h2>
            <p>Oformaterat:</p>
            <p><?= $orig_markdown ?></p>
            <p>Formaterat:</p>
            <?= $markdown ?>

        </main>
    </div>
</div>


