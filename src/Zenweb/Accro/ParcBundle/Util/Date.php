<?php
namespace Zenweb\Accro\ParcBundle\Util;


/**
 * Description
 *
 * @category Zenweb
 * @package  Zenweb_Aventure
 *
 * @author   Flavien Chantelot <flavien@zenweb.fr>
 * @date     03/02/14
 * @mantis   None
 */
class Date
{
    public function __construct()
    {
        setlocale(LC_TIME, "fr_FR");
    }

    /**
     * Return month by its key
     *
     * @param int $monthKey The month needed.
     *
     * @return  string
     *
     * @author  Flavien Chantelot <flavien@zenweb.fr>
     * @date    03/02/14
     * @mantis  None
     */
    public function getMonth($monthKey)
    {
        return strftime('%B', strtotime("$monthKey/01/2014"));
    }

    /**
     * Get next month and year
     *
     * @param int $monthKey Current month
     * @param int $yearKey  Current year
     * @param int $step     How far should we go ?
     *
     * @return  array
     *
     * @author   Flavien Chantelot <flavien@zenweb.fr>
     * @date     03/02/14
     * @mantis   None
     */
    public function getOtherMonth($monthKey, $yearKey, $step)
    {
        $currentDate         = mktime(0, 0, 0, $monthKey, 1, $yearKey);
        $nextDate[$monthKey] = date("m", strtotime("+$step month", $currentDate));
        $nextDate[$yearKey]  = date("Y", strtotime("+$step month", $currentDate));
        return $nextDate;
    }

    /**
     * Return the first day of the month & year
     *
     * @param int $monthKey Current month
     * @param int $yearKey  Current year
     *
     * @return  int
     *
     * @author   Flavien Chantelot <flavien@zenweb.fr>
     * @date     03/02/14
     * @mantis   None
     */
    public function getFirstDay($monthKey, $yearKey)
    {
        $tmstp  = mktime(0, 0, 0, $monthKey, 1, $yearKey);
        $dayKey = date("w", $tmstp);

        $tab_jour = array(0 => 7, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6); //This is for calendars with weeks starting on Mondays. Sunday returns a 0 which must be changed to 7

        return $tab_jour[$dayKey]; //for calendars with weeks starting on Sundays, just return $dayKey.
    }
} 