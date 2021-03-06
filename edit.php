<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
  if(empty($_SESSION['email'])){
    $url = "sign_in.html";
    header("Location: $url");
    }
  else
    {
      ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Members</title>
  <meta name="description" content="Description of your site goes here">
  <meta name="keywords" content="keyword1, keyword2, keyword3">
  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
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
       include_once 'config.php';
       $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to Server: " . mysql_error()); 
       $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to DB " . mysql_error()); 
       
      /* 
       NEW.PHP
       Allows user to create a new entry in the database
      */
      function renderForm($name, $dob, $contact_no, $address, $company, $email, $gender, $maritial_status, $newcomer, $baptism, $annointing, $zone_id, $ministry, $joined_on, $error, $id)
      {     
         // if there are any errors, display them
       if ($error != '')
       {
       echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
       }
       ?> 
       <form action="" method="post" enctype="multipart/form-data">
         <input type="hidden" name="id" value="<?php echo $id; ?>"/>
         <div class="add_member">
         <?php 
         $q = mysql_query("SELECT * FROM Members where member_id='$id'"); 
         
         if($q && $row_member = mysql_fetch_array($q)){
           if(!empty($row_member['image_url'])){
              echo "<img src='uploads/" . $row_member['image_url'] . "' width='70px' height='70px'><br><br>";
           }
         }
         ?>

         <label>Image: </label><input type="file" name="fileToUpload" id="fileToUpload"><br><br>
         <label>Name: *</label> <input type="text" name="name" value="<?php echo $name; ?>" /><br/><br/>
         <label>Gender: *</label> <input type="radio" name="gender" value="male" <?php echo ($gender=='male')?'checked':'' ?> >Male <input type="radio" name="gender" value="female" <?php echo ($gender=='female')?'checked':'' ?> >Female<br/><br/>
         <label>NewComer: *</label> <input type="radio" name="newcomer" value="1" <?php echo ($newcomer=='1')?'checked':'' ?> >Yes <input type="radio" name="newcomer" value=0 <?php echo ($newcomer=='0')?'checked':'' ?> >No.I am a Member<br/><br/>
         <label>Joined on: </label> <input type="date" name="joined_on" value="<?php echo $joined_on; ?>" /><br/><br/>
         <label>DOB: *</label> <input type="date" name="dob" value="<?php echo $dob; ?>" /><br/><br/>
         <label>Email: </label> <input type="text" name="email" value="<?php echo $email; ?>" /><br/><br/>
         <label>Contact Number: *</label> <input type="text" name="contact_no" value="<?php echo $contact_no; ?>" /><br/><br/>
         <label>Residential Address: *</label> <input type="text" name="address" value="<?php echo $address; ?>" /><br/><br/>
         <label>Company: </label> <input type="text" name="company" value="<?php echo $company; ?>" /><br/><br/>
         <label>Marital Status: *</label> <input type="radio" name="maritial_status" value='1' <?php echo ($maritial_status==1)?'checked':'' ?> > Married <input type="radio" name="maritial_status" value=0 <?php echo ($maritial_status=='0')?'checked':'' ?> > Unmarried<br/><br/>
         <label>Baptism: *</label> <input type="radio" name="baptism" value='1' <?php echo ($baptism==1)?'checked':'' ?> > Yes <input type="radio" name="baptism" value=0 <?php echo ($baptism=='0')?'checked':'' ?> > No <br><br>
         <label>Annointing: *</label> <input type="radio" name="annointing" value='1' <?php echo ($annointing==1)?'checked':'' ?> > Yes <input type="radio" name="annointing" value=0 <?php echo ($annointing=='0')?'checked':'' ?> > No <br><br>
         <label>Zone: *</label>
            <select name='zone'>
              <?php 
                $result_zones = mysql_query("SELECT * FROM zones where church_id = '$_SESSION[church_id]'") or die(mysql_error());  
                while($row_zone = mysql_fetch_array( $result_zones )) {
                  $s = $row_zone["id"]==$zone_id ? "selected" : "";
                  echo "<option value='" . $row_zone["id"] . "'" .  $s . ">". $row_zone["zonename"] . "</option>" ;
                }
              ?>
            </select><br><br><br>
         <label>Ministry: *</label> <br>
            <input type="checkbox" name="ministry[]" value="volunteer" <?php echo (in_array("volunteer", $ministry)) ? "checked" : "" ?> >volunteer<br>
            <input type="checkbox" name="ministry[]" value="leader" <?php echo (in_array("leader", $ministry)) ? "checked" : "" ?> >leader<br>
            <input type="checkbox" name="ministry[]" value="zonal leader" <?php echo (in_array("zonal leader", $ministry)) ? "checked" : "" ?> >zonal leader<br>
            <input type="checkbox" name="ministry[]" value="none" <?php echo (in_array("none", $ministry)) ? "checked" : "" ?> >none<br>

            <br><br><br>
         <p>* required</p>
         <br/>
         <br/>
         <input type="submit" name="submit" value="Submit">
         </div>
       </form> 
       <?php 
      }
 
 
       
       
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
           $newcomer = $_POST['newcomer'];
           $baptism = $_POST['baptism'];
           $annointing = $_POST['annointing'];
           $zone_id = $_POST['zone'];
           $ministry = $_POST['ministry'];
           $joined_on = $_POST['joined_on'];
           $target_dir = "uploads/";
           $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
           $uploadOk = 1;
           $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
           $error = '';
           if(!empty($_FILES["fileToUpload"]["tmp_name"])){
             $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
             $err = '';
              if($check !== false) {
                  echo "File is an image - " . $check["mime"] . ".";
                  $uploadOk = 1;
              } else {
                  $err = "File is not an image.";
                  $uploadOk = 0;
              }
              if (file_exists($target_file)) {
                  $err = "Sorry, file already exists.";
                  $uploadOk = 0;
              }
              if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
              if ($uploadOk == 0) {
                  $error = $err . "Sorry, your file was not uploaded.";
                  renderForm($name, $dob, $contact_no, $address, $company, $email, $gender, $maritial_status, $newcomer, $baptism, $annointing, $zone_id, $ministry, $joined_on, $error, $id);
              }
            }
            if($uploadOk == 0 && !empty($_FILES["fileToUpload"]["tmp_name"])) 
             {
                //Dont do anything if file is wrong
                renderForm($name, $dob, $contact_no, $address, $company, $email, $gender, $maritial_status, $newcomer, $baptism, $annointing, $zone_id, $ministry, $joined_on, $error, $id);
             }
           else if ($name == '' || $dob == '' || $address == '' || $gender == '' || $maritial_status == '' || $newcomer== '' || $baptism=='' || $annointing=='' || $zone_id=='' || sizeof($ministry)==0)
           {
           // generate error message
           $error = 'ERROR: Please fill in all required fields!';
           
           // if  field is blank, display the form again
           renderForm($name, $dob, $contact_no, $address, $company, $email, $gender, $maritial_status, $newcomer, $baptism, $annointing, $zone_id, $ministry, $joined_on, $error, $id);
           }
           else
           {
            if(!empty($_FILES["fileToUpload"]["tmp_name"])){
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
              $image_url = basename( $_FILES["fileToUpload"]["name"]);
              $uploadOk = 2; 
              } else {
              echo "Sorry, there was an error uploading your file.";
              $image_url = '';
              $uploadOk = 0 ;
              }
            }
            else
              $image_url = '';

           $query = "UPDATE Members SET name='$name', dob='$dob', company='$company', email='$email', contact_no='$contact_no',  residential_address='$address', gender='$gender', `maritial status`='$maritial_status',  `newcomer`='$newcomer', `baptism`='$baptism', `annointing`='$annointing', `zone_id`='$zone_id' ";
           if($joined_on!='')
            $query = $query . ", `joined_on`='$joined_on' ";
           if($uploadOk == 2)
            $query = $query . ", `image_url`='$image_url' ";
           $query = $query . "where member_id='$id' " ;
           echo $query . "\n\n\n\n";
           $query_delete_ministry = mysql_query("DELETE FROM ministry WHERE member_id='$id' AND church_id='$_SESSION[church_id]'") or die(mysql_error()); 
           for($i=0; $i<sizeof($ministry); $i++){
             mysql_query("INSERT ministry set member_id='$id', ministry_name='$ministry[$i]', zone_id='$zone_id', church_id='$_SESSION[church_id]'"); 
             if($ministry[$i] == 'zonal leader')
             {

             }
            }
           // save the data to the database
           mysql_query($query) or die(mysql_error()); 
           ob_clean();
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
             $result = mysql_query("SELECT * FROM Members WHERE member_id='$id' AND church_id='$_SESSION[church_id]'") or die(mysql_error()); 
             
             $row = mysql_fetch_array($result);
             
             // check that the 'id' matches up with a row in the databse
             if($row)
             {
             $result_ministry = mysql_query("SELECT * FROM ministry WHERE member_id='$id' AND church_id='$_SESSION[church_id]'") or die(mysql_error()); 
             

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
             $newcomer = $row['newcomer'];
             $baptism = $row['baptism'];
             $annointing = $row['annointing'];
             $zone_id = $row['zone_id'];
             $ministry = array();
             while($row_ministry = mysql_fetch_array( $result_ministry )) {
              array_push($ministry, $row_ministry['ministry_name']);
             }
             $joined_on = $row['joined_on'];
             // show form
             renderForm($name, $dob, $contact_no, $address, $company, $email, $gender, $maritial_status, $newcomer, $baptism, $annointing, $zone_id, $ministry, $joined_on,  '', $id);
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
</html>
<?php }  ?>