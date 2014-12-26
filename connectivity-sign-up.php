<?php 
include_once 'config.php';
$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); 
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error()); 
function NewUser() 
  { $fullname = $_POST['name'];
    $pastorname = $_POST['pastorname'];
    $churchName = $_POST['churchName'];
    $email = $_POST['email'];
    $password = $_POST['pass']; 
    $query = "INSERT INTO WebsiteUsers (name, churchName, email, pass, status, pastorname) VALUES('$fullname','$churchName','$email','$password', 1,'$pastorname')";
    $data = mysql_query ($query)or die(mysql_error()); 
    if($data) 
    	{ echo "YOUR REGISTRATION IS COMPLETED...Request has gone for authorization..."; 
		}
  } 

  function SignUp() { 
  if(!empty($_POST['email'])) //checking the 'user' name which is from Sign-Up.html, is it empty or have some text 
  	{
  	 $query = mysql_query("SELECT * FROM WebsiteUsers WHERE email = '$_POST[email]'") or die(mysql_error()); 
  	 if(!$row = mysql_fetch_array($query) or die(mysql_error())) 
  	 	{ newuser(); } 
  	 else { 
  		echo "SORRY...YOU ARE ALREADY REGISTERED USER..."; 
  		} 
  	}
   } 
   if(isset($_POST['submit'])) { SignUp(); } 
   $url = "sign_in.html";
   header("Location: $url");
   ?>

