<?php

namespace App\Services\Date;


class DateCheck 
{
    /**
     * Check dates
     *
     * @return void
     */
    public static function isValid($str_dt, $str_dateformat = "Y-m-d H:i", $str_timezone = FALSE)
    {
        $date = \DateTime::createFromFormat($str_dateformat, $str_dt/*, new DateTimeZone($str_timezone)*/);
        
        if($date && (int)($date->format("Y")) < 1900) {
			return false;
		}
  		return $date && \DateTime::getLastErrors()["warning_count"] == 0 && \DateTime::getLastErrors()["error_count"] == 0;
    }
}
