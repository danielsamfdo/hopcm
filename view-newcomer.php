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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>New Comers</title>
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
<p><strong>View Members</strong><br>
</div>
</div>
<div class="row2">
  <div class="members_listing">

    <?php
       include_once 'config.php';
       include_once 'global_functions.php';
       $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to Server: " . mysql_error()); 
       $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to DB " . mysql_error()); 
       $result = mysql_query("SELECT * FROM Members where church_id = '$_SESSION[church_id]' AND newcomer=true") or die(mysql_error());  
    
        // display data in table
        echo "<p><b>View All</b> | <a href='view-paginated-newcomer.php?page=1'>View Paginated</a></p>";
        
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Name</th> <th>Gender</th> <th>DOB</th> <th>Contact Number</th> <th>Age</th> <th>Address</th> <th>Married</th> <th></th><th></th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
          
          // echo out the contents of each row into a table
          echo "<tr>";
          echo '<td>' . $row['name'] . '</td>';
          echo '<td>' . $row['gender'] . '</td>';
          echo '<td>' . format_date($row['dob']) . '</td>';
          echo '<td>' . $row['contact_no'] . '</td>';
          echo '<td>' . date_diff(date_create($row['dob']), date_create('today'))->y . '</td>';
          //echo '<td>' . $row['email'] . '</td>';
          echo '<td>' . $row['residential_address'] . '</td>';
          echo '<td>' . yes_or_no($row['maritial status']) . '</td>';
          echo '<td><a href="move-to-member.php?id=' . $row['member_id'] . '">Add Permanent</a></td>';
          echo '<td><a onclick="return confirm(\'Are you sure you want to delete this member?\')" href="delete.php?id=' . $row['member_id'] . '">Delete</a></td>';
          echo "</tr>"; 
        } 

        // close table>
        echo "</table>";
    ?>
    <p><a href="new.php">Add a new record</a></p>
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
<?php } ?>