<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'iot');
define('DB_USER','itachi');
define('DB_PASSWORD','root');
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

if(isset($_POST['mddata'])){
 $json = $_POST['mddata'];


$id=$json;
$query_man = mysql_query("select * from Device where id='$id'")or die(mysql_error());
$row_man = mysql_fetch_array($query_man) or die(mysql_error());
echo $row_man['status'];
$sta = $row_man['status'];
$pin = $row_man['gpiopin'];

if($sta==false){
    shell_exec("gpio -g write $pin 0");
	$query123=mysql_query("update Device set status=1 where id='$id'")or die(mysql_error());

}
else
{
	shell_exec("gpio -g write $pin 1");
	$query1234=mysql_query("update Device set status=0 where id='$id'")or die(mysql_error());


}
}
else{
echo 'noob';
}

?>
