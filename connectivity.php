<?php
 include_once 'config.php';
 $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error()); 
 $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error()); 
 /* $ID = $_POST['user']; $Password = $_POST['pass']; */ 
 function SignIn() { 
 	  session_start();
    //starting the session for user profile page 
    if(!empty($_POST['email'])) //checking the 'user' name which is from Sign-In.html, is it empty or have some text 
    { echo "fds";
      $query = mysql_query("SELECT * FROM WebsiteUsers where email = '$_POST[email]' AND pass = '$_POST[pass]'") or die(mysql_error()); 
      if(mysql_num_rows($query)>0){
        $row = mysql_fetch_array($query) or die(mysql_error());
        echo mysql_num_rows($query). "Asd";
        if($row['status'] == 2) 
      	 { 
      			$_SESSION['email'] = $row['email'];
            $_SESSION['churchName'] = $row['churchName'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['church_id'] = $row['userID'];

         		echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE..."; 
            header("Location: home.php");
          }
          else
          {
           		echo "pending acceptance or deleted / invalid credentials";
              header("Location: sign_in.html");   
          }
      }
      else{
        echo " TEST pending acceptance or deleted / invalid credentials";
        header("Location: sign_in.html");   
      }
    }
 } 
 if(isset($_POST['submit'])) 
 {
  SignIn(); 
 } 
?>

