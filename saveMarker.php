<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'iot');
define('DB_USER','itachi');
define('DB_PASSWORD','root');
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

if(isset($_POST['mdata'])){
 $json = $_POST['mdata'];
 $result= json_decode($json,true);
	$id = $result[id];
	$name = $result[tooltip];
	$latitude = $result[latitude];
	$longitude = $result[longitude];

	$query_gpio_Assign = mysql_query("select * from GPIO where IsFree=1 ORDER BY RAND() LIMIT 1") or die(mysql_error());
    $row = mysql_fetch_array($query_gpio_Assign) or die(mysql_error());
	$pin=$row['gpiopin'];
	$query_gpio_update = mysql_query("update GPIO set IsFree=0 where gpiopin=$pin") or die(mysql_error());
	$gpio_string = (string)$pin;
	$query = mysql_query("INSERT INTO Device(id,name,latitude,longitude,gpiopin) values('$id','$name','$latitude','$longitude','$gpio_string')") or 	die(mysql_error());
	shell_exec("gpio -g mode $pin out");
    shell_exec("gpio -g write $pin 1");

}

else{
echo 'noob';
}

?>
