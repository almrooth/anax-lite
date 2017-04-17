<?php

$month = isset($_POST["month"]) ? $_POST["month"] : null;
$year = isset($_POST["year"]) ? $_POST["year"] : null;
$action = isset($_POST["action"]) ? $_POST["action"] : null;

if ($action == "prev") {
    if ($month == 1) {
        $month = 12;
        $year--;
    } else {
        $month--; 
    }
} elseif ($action == "next") {
    if ($month == 12) {
        $month = 1;
        $year++;
    } else {
        $month++;
    }
}
$image = $app->url->asset("img/calendar.jpg");
$cal = $app->calendar->getCalendar($year, $month);

?>

<div class="outer-wrap outer-wrap-home">
    <div class="inner-wrap inner-wrap-home">
        <div class="row">
            <main class="site-main site-calendar">

                <h1>Calendar</h1>
                <div class="calendar-container">
                    <img class="calendar-img" src="<?= $image ?>">
                    <div class="calendar-cal">
                        <h2><?= $app->calendar->getDateString() ?></h2>
                        <?= $cal ?>

                        <form action="" method="POST">
                            <input type="hidden" name="month" value="<?= $app->calendar->getMonth() ?>">
                            <input type="hidden" name="year" value="<?= $app->calendar->getYear() ?>">
                            <button class="" type="submit" name="action" value="prev">Previous month</button>
                            <button class="" type="submit" name="action" value="next">Next month</button>
                        </form>
                    </div>
                </div>

            </main>
        </div>
    </div>
</div>