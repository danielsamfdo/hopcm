<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Add New Members</title>
  <meta name="description" content="Description of your site goes here">
  <meta name="keywords" content="keyword1, keyword2, keyword3">
  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
	if(!empty($_SESSION['email'])){
?>

<body>
<div class="main-out">
<div class="main">
<div class="page">
<div class="top">
<div class="header">
<div class="header-top">
<h1><?php echo $_SESSION['churchName']; ?></h1>
<p>Call Us: 000 0000 000</p>
</div>
<div class="topmenu">
<ul>
  <li><a href="index.html">Home</a></li>
  <li><a href="#">About&nbsp;Us</a></li>
  <li><a href="#">What's&nbsp;New</a></li>
  <li><a href="#">Services</a></li>
  <li><a href="#">Contact</a></li>
  <li><a href="#">Resources</a></li>
  <li><a href="#">Links</a></li>
</ul>
</div>
<div class="header-img">
<h2>God is good</h2>
</div>
</div>
<div class="content">
<div class="content-left">
<div class="row1">
<div class="img"><img src="images/img1.jpg" alt="" height="101"
 width="157"></div>
<div class="welcome">
<h1 class="title">Welcome <span><?php echo $_SESSION["name"]; ?></span></h1>
<p><strong>Add a Zone</strong><br>
</div>
</div>
<div class="row2">
  <div class="add_zone">

    <?php
      /* 
       NEW.PHP
       Allows user to create a new entry in the database
      */
      function renderForm($zonename,  $error)
      {     
         // if there are any errors, display them
       if ($error != '')
       {
       echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
       }
       ?> 
       <form action="" method="post">
         <div class="add_zone">
         <label>ZoneName: *</label> <input type="text" name="zonename" value="<?php echo $zonename; ?>" /><br/><br/>
         <p>* required</p>
         <br/>
         <br/>
         <input type="submit" name="submit" value="Submit">
         </div>
       </form> 
       <?php 
      }
 
 
       
       include_once 'config.php';
       $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to Server: " . mysql_error()); 
       $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to DB " . mysql_error()); 
       
       // check if the form has been submitted. If it has, start to process the form and save it to the database
       if (isset($_POST['submit']))
       { 
       // get form data, making sure it is valid
       $zonename = mysql_real_escape_string(htmlspecialchars($_POST['zonename']));
       
       // check to make sure both fields are entered
       if ($zonename == '')
       {
       // generate error message
       $error = 'ERROR: Please fill in the required field!';
       
       // if either field is blank, display the form again
       renderForm($zonename, $error);
       }
       else
       {
       $query = "INSERT zones SET zonename='$zonename', church_id='$_SESSION[church_id]' ";

       // save the data to the database
       mysql_query($query) or die(mysql_error()); 
       
       // once saved, redirect back to the view page
       header("Location: view.php"); 
       }
       }
       else
       // if the form hasn't been submitted, display the form
       {
       renderForm('', '');
       }
      ?>







  </div>
</div>
</div>
<div class="content-right">
<h2>Main Menu</h2>
<?php include('side_links_template.php'); ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
</div>
</div>
<div class="bottom">
<ul>
  <li style="border-left: medium none;"><a href="index.html">Home</a></li>
  <li><a href="#">About&nbsp;Us</a></li>
  <li><a href="#">What's&nbsp;New</a></li>
  <li><a href="#">Services</a></li>
  <li><a href="#">Contact</a></li>
  <li><a href="#">Resources</a></li>
  <li><a href="#">Links</a></li>
</ul>

<!--DO NOT Remove The Footer Links-->
<p>&copy; Copyright 2014. Designed by <a target="_blank" href="http://www.htmltemplates.net">HTML Templates</a></p>
<!--Designed by--><a target="_blank" href="http://www.htmltemplates.net">
<img src="images/footnote.gif" class="copyright" alt="HTML Templates"></a></div>
<!--DO NOT Remove The Footer Links-->
</div>
</div>
</div>
</body>
<?php }
	else{
		$url = "sign_in.html";
   		header("Location: $url");
   	}
	?>
</html>