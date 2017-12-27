<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'iot');
define('DB_USER','itachi');
define('DB_PASSWORD','root');

$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());
/*
$ID = $_POST['user'];
$Password = $_POST['pass'];
*/
function SignIn()
{
session_start();   //starting the session for user profile page
if(!empty($_POST['un']))   //checking the 'user' name which is from Sign-In.html, is it empty or have some text
{
	$query = mysql_query("SELECT *  FROM login where username = '$_POST[un]' AND password = '$_POST[pw]'") or die(mysql_error());
	$row = mysql_fetch_array($query) or die(mysql_error());
	if(!empty($row['username']) AND !empty($row['password']))
	{
		$_SESSION['username'] = $row['password'];
	header('Location:main-page.php');

	}
	
}
}
if(isset($_POST['submit']))
{
	SignIn();
}else
	{
	header('Location:index.html');
	}

?>
