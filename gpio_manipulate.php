<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'iot');
define('DB_USER','itachi');
define('DB_PASSWORD','root');
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

if(isset($_POST['m1data'])){
 $json = $_POST['m1data'];
 $result= var_export(json_decode($json,true));
/*
$id = $result[id];

$query_man = mysql_query("select * from Device where id='$id'");
$row_man = mysql_fetch_array($query_man) or die(mysql_error());

$sta = $row_man['status'];
$pin = $row_man['gpiopin'];

if($sta==0){
    shell_exec("gpio -g write $pin 0");
	mysql_query("update table Device set status = 1 where id='$id'");

}
else
	shell_exec("gpio -g write $pin 1");
	mysql_query("update table Device set status = 0 where id='$id'");

*/


?>
