<?php
class Inventory
{
    /**
     * @param $currency_code
     * @param $location_id
     * @return array
     * This method will return the current inventory amounts of a location
     */
    public static function getDenomsFor($currency_code, $location_id){
        $sql = "SELECT denom_value, amount 
            FROM denom_inventory
            WHERE location_id=:location_id AND currency_code=:currency_code
            ORDER BY denom_value DESC 
        ";
        $params = array(
            'currency_code'=>$currency_code, 
            'location_id'=>$location_id
        );
        $db = new DB();
        return $db->query($sql, $params);
    }

    /**
     * @param $amount
     * @param $denoms
     * @return array
     * This method will return a mix of currency to satisfy this amount based on what is available in inventory
     */
    public static function breakdownDenominations($amount, $denoms) {
        $count = array();
        foreach ($denoms as $row) {
            $value = $row['denom_value'];
            $value_count = $row['amount'];
            while ($amount >= $value && $value_count > 0) {
                $amount = $amount - $value;
                $value_count--;
                if (!isset($count[(string)$value])) {
                    $count[(string)$value] = 1;
                } else {
                    $count[(string)$value]++; // track the occurrence of each denomination
                }
            }
        }
        return $count;
    }

    public static function Denominations($amount, $denoms) {
        $count = array();
        foreach ($denoms as $row) {
            $value = $row['denom_value'];
            $value_count = $row['amount'];
            while ($amount >= $value && $value_count > 0) {
                $amount = $amount - $value;
                $value_count--;
                if (!isset($count[(string)$value])) {
                    $count[(string)$value] = 1;
                } else {
                    $count[(string)$value]++; // track the occurrence of each denomination
                }
            }
        }
        return $count;
    }
}