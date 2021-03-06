<?php

namespace Talm\Calendar;

class Calendar
{
    private $year;
    private $month;

    private $weeks = [];

    /**
     * Generate all days of a month
     *
     * @param [type] $year
     * @param [type] $month
     * @return void
     */
    public function genDays($year = null, $month = null)
    {
        $this->year = isset($year) ? $year : date("y");
        $this->month = isset($month) ? $month : date("m");
        
        $firstDate = new \DatetimeImmutable($this->year . "-" . $this->month . "-01");
        $endDate = $firstDate->modify("last day of this month");
        $endDate = $endDate->modify("+1 day");

        $interval = new \DateInterval("P1D");

        $days = new \Dateperiod($firstDate, $interval, $endDate);

        $this->weeks = $this->splitToWeeks($days);
    }

    /**
     * Return the current month
     *
     * @return int the current month
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Return the current year
     *
     * @return int the current year
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Return year and month as string
     *
     * @return string 
     */
    public function getDateString()
    {
        $date = new \DatetimeImmutable($this->year . "-" . $this->month . "-01");
        return $date->format("Y") . " " . $date->format("F");
    }

    /**
     * Split all of months days into arrays based on weeks
     *
     * @param array $days Array of all days of month as Datetime objects
     * @return array Array of arrays of weeks
     */
    public function splitToWeeks($days)
    {   
        $weekNr = 0;
        $weeks[$weekNr] = array();

        foreach ($days as $day) {
            isset($weeks[$weekNr]) or $weeks[$weekNr] = array(); 
            array_push($weeks[$weekNr], $day);
            if ($day->format("N") == 7) {
                $weekNr++;
            }
        }

        return $weeks;
    }

    /**
     * Pad a week to 7 days
     *
     * @param array $week Array of Datetime objects, that months day of a week
     * @return array Array of length 7
     */
    public function padWeek($week)
    {
        if ($week[0]->format("N") != 1) {
            return array_pad($week, -7, -1);
        } else {
            return array_pad($week, 7, 1);
        }
    }

    /**
     * Return HTML for a week
     *
     * @param array $week Array containing all weeks days as Datetime objecys
     * @return string $HTML The html for a week
     */
    public function getWeekHtml($week)
    {
        $html = "<tr>";

        if (count($week) < 7) {
            $week = $this->padWeek($week);
        }

        foreach ($week as $day) {     
            if (is_int($day)) {
                $html .= "<td></td>";
            } else {
                if ($day->format("N") == 7) {
                    $redDay = "red-day";
                } else {
                    $redDay = "";
                }             

                $html .= "<td class='$redDay'>";
                $html .= $day->format("d");
                $html .= "</td>";
            }                        
        }

        $html .= "</tr>";

        return $html;
    }

    /**
     * Get HTML for calendar
     *
     * @param int $year
     * @param int $month
     * @return string $HTML The html for the calendar
     */
    public function getCalendar($year, $month)
    {
        $this->genDays($year, $month);

        $weekdays = [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
            "Sunday"
        ];


        $html = "<h2></h2><table>";

        $html .= "<tr>";

        foreach ($weekdays as $weekday) {
            $html .= "<th>$weekday</th>";
        }

        $html .= "<tr>";

        foreach ($this->weeks as $week) {
            $html .= $this->getWeekHtml($week);
        }

        $html .= "</table>";

        return $html;
    }
}
