<?php
/**
 * PhpExerciseClass Class
 * The class is used to calculate two different date
 * It helps to render dropdown list for Day,Month and Year
 * It helps to convert date and time
 * @package    PhpExerciseClass
 * @author     Senthilkumar Gunasekaran <gskumarmail@gmail.com>
 */
class PhpExerciseClass
{
    public $dateFormat = 'Y-m-d H:i:s';
    public $diff = 0;
    public $modify_string = array('wed' => 'next wednesday 8pm', 'sat' => 'next saturday 8pm');
    public $year_dropdown_limit = 10;
    
    /**
     * Class Constructor - Initializing data calculation
     * @param string $userSuppliedDate passing day,month and year
     */
    public function __construct($userSuppliedDate = "")
    {
        $this->current_date       = date($this->dateFormat);
        $this->now                = time();
        $this->user_supplied_date = $userSuppliedDate;
    }
    /**
     * Checks if date passed by the user supplied date.
     * if not passed, set current date and time
     * @return Object Returns Object of date and time
     */
    public function getDateTimeObj()
    {
        $supplied_datetime = ($this->user_supplied_date) ? $this->getDateTime($this->user_supplied_date) : $this->getDateTime($this->current_date);
        return $supplied_datetime;
    }
    /**
     * Get date and time passed an optional supplied date
     * @return Object Returns object of date and time
     */
    public function getDateTime($dateTime)
    {
        $date_time = new DateTime($dateTime);
        return $date_time;
    }
    /**
     * Calculates and returns the next valid
     * draw date based on the current date and time and also on an optional supplied date.
     * @return date Returns date Year,Month,Day,hours,mins and seconds of the file
     */
    public function getNextDrawDate()
    {
        $date_time_obj = $this->getDateTimeObj();
        $draw_date_wed = $date_time_obj->modify($this->modify_string["wed"])->format($this->dateFormat);
        $date_time_obj = $this->getDateTime($this->user_supplied_date);
        $draw_date_sat = $date_time_obj->modify($this->modify_string["sat"])->format($this->dateFormat);
        $this->diff    = (strtotime($draw_date_wed) - strtotime($draw_date_sat));
        $draw_date     = ($this->diff > 0) ? $draw_date_sat : $draw_date_wed;
        return $this->dateName($draw_date);
    }
    /**
     * Convert and returns the date names like 'March 31, 2018 - Saturday 8:00 PM'
     * Convert date name based on the param date and time.
     * @return String Returns date names like ''March 31, 2018 - Saturday 8:00 PM'
     */
    public function dateName($date)
    {
        $date_name    = "";
        $convert_date = strtotime($date);
        $month        = date('F', $convert_date);
        $year         = date('Y', $convert_date);
        $name_day     = date('l', $convert_date);
        $day          = date('j', $convert_date);
        $time         = date('g:i A', $convert_date);
        $date_name    = $month . " " . $day . ", " . $year . " - " . $name_day . " " . $time;
        return $date_name;
    }
    /**
     * Create days dropdown list range from 1 to 31
     * @return <option> list with current selected date
     */
    public function drop_down_days()
    {
        $days = '';
        foreach (range(1, 31) as $day) {
            $selected = ($day == date('j', $this->now)) ? ' selected="selected"' : '';
            $days .= '<option value="' . $day . '"' . $selected . '>' . $day . "</option>\n";
        }
        return $days;
    }
    /**
     * Create months dropdown list range from 1 to 12
     * Append month name from the array list
     * @return <option> list all the month with current selected month
     */
    public function drop_down_months()
    {
        $months      = '';
        $month_array = array(
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        );
        $i           = 0;
        foreach (range(1, 12) as $month) {
            $selected = ($month == date('m', $this->now)) ? 'selected="selected"' : '';
            $months .= '<option value="' . $month . '"' . $selected . '>' . $month . " ( " . $month_array[$i] . " )</option>\n";
            $i++;
        }
        return $months;
    }
    /**
     * Create months dropdown list range from current year to next 10 years ahead
     * @return <option> list next 10 years with current selected year
     */
    public function drop_down_years()
    {
        $years      = '';
        $start_year = date('Y');
        $end_year   = date('Y', mktime(0, 0, 0, 0, 0, date('Y') + $this->year_dropdown_limit));
        foreach (range($start_year, $end_year) as $year) {
            $selected = ($year == date('Y', $this->now)) ? 'selected="selected"' : '';
            $years .= '<option value="' . $year . '"' . $selected . '>' . $year . "</option>\n";
        }
        return $years;
    }
}