<?php

$base_dir = dirname(__FILE__);
$classes_dir = $base_dir . '/classes/';
/* BASE LIBRARY PATH APPENDED TO PHP INCLUDE PATH */
set_include_path(get_include_path() . ':' . $classes_dir);

/**
 * AUTOLOAD FUNCTION - You no longer have to require or include each individual class
 * @param $class_name
 */
function __autoload($class_name)
{
    include $class_name . '.php';
}

header('Content-Type: application/json');
$status = array('code'=>'success', 'message'=>'');

//clean up thousands separator and convert to integer
$amount = $_REQUEST['amount'];
$amount = SysRequest::cleanAmount($amount);

// validate location_id
$location_id = $_REQUEST['location_id'];
if(!SysRequest::isValidInt($location_id)){
    $status = array("code"=>"error", "message"=>"Error: Invalid Location ID '$location_id'");
    $response = array('status'=>$status,'denom'=>'');
    echo json_encode($response);
    exit;
}

// validate currency_code

$currency_code = $_REQUEST['currency_code'];
if(!SysRequest::isValidCurrencyCode($currency_code)){
    $status = array("code"=>"error", "message"=>"Error: Invalid Currency Code '$currency_code'");
    $response = array('status'=>$status,'denom'=>'');
    echo json_encode($response);
    exit;
}
else $denoms = Inventory::getDenomsFor($currency_code, $location_id);

$total = 0;
foreach ($denoms as $row) {
    $total += $row['denom_value'] * $row['amount'];
}

if ($total < $amount) {
    $status = array("code"=>"error", "message"=>"Error: You requested $amount $currency_code. Current inventory of a location($location_id) is $total $currency_code");
    $response = array('status'=>$status,'denom'=>'');
    echo json_encode($response);
    exit;
}

$breakdown = Inventory::breakdownDenominations($amount, $denoms);

$mix = 0;
foreach ($breakdown as $key=>$value){
    $mix += $key * $value;
}
if($amount != $mix){
    $status = array("code"=>"warning", "message"=>"Warning: Original amount $amount $currency_code is not equal a mix of currency amount $mix $currency_code");
}

$response = array('status'=>$status,'denom'=>$breakdown);
echo json_encode($response);


