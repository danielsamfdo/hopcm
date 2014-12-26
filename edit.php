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
<p><strong>Add a Member</strong><br>
</div>
</div>
<div class="row2">
  <div class="add_member">

    <?php
      /* 
       NEW.PHP
       Allows user to create a new entry in the database
      */
      function renderForm($name, $dob, $contact_no, $address, $company, $email, $gender, $maritial_status, $error, $id)
      {     
         // if there are any errors, display them
       if ($error != '')
       {
       echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
       }
       ?> 
       <form action="" method="post">
         <input type="hidden" name="id" value="<?php echo $id; ?>"/>
         <div class="add_member">
         <label>Name: *</label> <input type="text" name="name" value="<?php echo $name; ?>" /><br/><br/>
         <label>Gender: *</label> <input type="radio" name="gender" value="male" <?php echo ($gender=='male')?'checked':'' ?> >Male <input type="radio" name="gender" value="female" <?php echo ($gender=='female')?'checked':'' ?> >Female<br/><br/>
         <label>DOB: *</label> <input type="date" name="dob" value="<?php echo $dob; ?>" /><br/><br/>
         <label>Email: </label> <input type="text" name="email" value="<?php echo $email; ?>" /><br/><br/>
         <label>Contact Number: *</label> <input type="text" name="contact_no" value="<?php echo $contact_no; ?>" /><br/><br/>
         <label>Residential Address: *</label> <input type="text" name="address" value="<?php echo $address; ?>" /><br/><br/>
         <label>Company: </label> <input type="text" name="company" value="<?php echo $company; ?>" /><br/><br/>
         <label>Marital Status: *</label> <input type="radio" name="maritial_status" value='1' <?php echo ($maritial_status==1)?'checked':'' ?> > Married <input type="radio" name="maritial_status" value=0 <?php echo ($maritial_status=='0')?'checked':'' ?> > Unmarried<br/>
         
         
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
        if (is_numeric($_POST['id']))
        {
           // get form data, making sure it is valid
           $name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
           $dob = $_POST['dob'];
           $address = $_POST['address'];
           $contact_no = $_POST['contact_no'];
           $gender = $_POST['gender'];
           $maritial_status = $_POST['maritial_status'];
           $company = $_POST['company'];
           $email = $_POST['email'];
           $id = $_POST['id'];
           
           // check to make sure both fields are entered
           if ($name == '' || $dob == '' || $address == '' || $gender == '' || $maritial_status == '')
           {
           // generate error message
           $error = 'ERROR: Please fill in all required fields!';
           
           // if either field is blank, display the form again
           renderForm($name, $dob, $contact_no, $address, $company, $email, $gender, $maritial_status, $error, $id);
           }
           else
           {
           $query = "UPDATE Members SET name='$name', dob='$dob', company='$company', email='$email', contact_no='$contact_no',  residential_address='$address', gender='$gender', `maritial status`='$maritial_status' where member_id='$id' ";
           // save the data to the database
           mysql_query($query) or die(mysql_error()); 
           
           // once saved, redirect back to the view page
           header("Location: view.php"); 
           }
         }
         else{
           echo 'Error ffff!';
         }
       }
       else
       // if the form hasn't been submitted, display the form
       {
       // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
           if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
           {
           // query db
             $id = $_GET['id'];
             $result = mysql_query("SELECT * FROM Members WHERE member_id='$id' AND church_id='$_SESSION[church_id]'")
             or die(mysql_error()); 
             $row = mysql_fetch_array($result);
             
             // check that the 'id' matches up with a row in the databse
             if($row)
             {
             
             // get data from db
             $name = $row['name'];
             $dob = $row['dob'];
             $address = $row['residential_address'];
             $contact_no = $row['contact_no'];
             $gender = $row['gender'];
             $maritial_status = $row['maritial status'];
             $company = $row['company'];
             $email = $row['email'];
             $id = $row['member_id'];
             
             // show form
             renderForm($name, $dob, $contact_no, $address, $company, $email, $gender, $maritial_status, '', $id);
             }
             else
             // if no match, display result
             {
             echo "No results!";
             }
           }
           else
           // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
           {
           echo 'Error!';
           }
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
