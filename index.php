<?php
session_start();
$con = mysql_connect("localhost","itachi","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("iot", $con);

if(isset($_POST['submit']){
$usr = $_POST['un'];

$pwd = $_POST['pw'];
$query = mysql_query("SELECT * FROM login WHERE username=$usr AND password=$pwd") or die("Error: " . mysql_error());
$result=mysql_fetch_array($query);

if($result)
echo "pp";
else
echo "yy";
}


?>




<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login & Register form</title>
    
    
    
    
        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>

    <div class="login-wrap">
  <h2>Login</h2>
  
  <div class="form">
  <form  name='form-2' method='post' action='#'>
    <input type="text" placeholder="Username" name="un" />
    <input  type="password" placeholder="Password" name="pw" />
    <button name='submit' type='submit' > Sign in </button>
    </form>
  </div>
</div>
    <script src='https://code.jquery.com/jquery-1.10.0.min.js'></script>

       

    
    
    
  </body>
</html>
