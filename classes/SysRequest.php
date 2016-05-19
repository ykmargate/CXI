<?php

class SysRequest
{
    /**
     * @param $arg
     * @return bool
     */
    public static function isValidInt($arg){
        if(is_numeric($arg)){
            return (int)$arg;
        }
        else return false;
    }

    /**
     * @param $arg
     * @return mixed
     */
    public static function cleanString($arg){
        $res = preg_replace("/[^a-zA-Z]/", "", $arg);
        return $res;
    }

    /**
     * @param $amount
     * @return int
     */
    public static function cleanAmount($amount){
        return (int)preg_replace("/\..+$/i", "", preg_replace("/[^0-9\.]/i", "", $amount));
    }

    /**
     * @param $currency_code
     * @return bool|string
     */
    public static function isValidCurrencyCode($currency_code){
        $currency_code = strtoupper(self::cleanString(trim($currency_code)));
        if(strlen($currency_code) != 3) return false;
        $db = new DB();
        $sql = "SELECT DISTINCT currency_code FROM denom_inventory";
        $codes = $db->query($sql);
        foreach ($codes as $row){
            if($row['currency_code'] == $currency_code) return $currency_code; 
        }
        return false;
    }
}
