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
  <title>View Members</title>
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
       $result = mysql_query("SELECT * FROM Members where church_id = '$_SESSION[church_id]'  AND newcomer='0'") or die(mysql_error());  
       $per_page = 3;
       $total_results = mysql_num_rows($result);
       $total_pages = ceil($total_results / $per_page);

       // check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
       if (isset($_GET['page']) && is_numeric($_GET['page']))
        {
          $show_page = $_GET['page'];
          
          // make sure the $show_page value is valid
          if ($show_page > 0 && $show_page <= $total_pages)
          {
            $start = ($show_page -1) * $per_page;
            $end = $start + $per_page; 
          }
          else
          {
            // error - show first set of results
            $start = 0;
            $end = $per_page; 
          }   
        }
        else
        {
          // if page isn't set, show first set of results
          $start = 0;
          $end = $per_page; 
        }
        
        // display pagination
        
        echo "<p><a href='view.php'>View All</a> | <b>View Page:</b> ";
        for ($i = 1; $i <= $total_pages; $i++)
        {
          echo "<a href='view-paginated.php?page=$i'>$i</a> ";
        }
        echo "</p>";
          
        // display data in table
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Name</th> <th>Gender</th> <th>DOB</th> <th>Contact Number</th> <th>Age</th> <th>Address</th> <th>Married</th> <th></th><th></th></tr>";

        // loop through results of database query, displaying them in the table 
        for ($i = $start; $i < $end; $i++)
        {
          // make sure that PHP doesn't try to show results that don't exist
          if ($i == $total_results) { break; }
        
          // echo out the contents of each row into a table
          echo "<tr>";
          echo '<td>' . mysql_result($result, $i, 'name') . '</td>';
          echo '<td>' . mysql_result($result, $i, 'gender') . '</td>';
          echo '<td>' . format_date(mysql_result($result, $i, 'dob')) . '</td>';
          echo '<td>' . mysql_result($result, $i, 'contact_no') . '</td>';
          echo '<td>' . date_diff(date_create(mysql_result($result, $i, 'dob')), date_create('today'))->y . '</td>';
          //echo '<td>' . mysql_result($result, $i, 'email') . '</td>';
          echo '<td>' . mysql_result($result, $i, 'residential_address') . '</td>';
          echo '<td>' . yes_or_no(mysql_result($result, $i, 'maritial status')) . '</td>';
          echo '<td><a href="edit.php?id=' . mysql_result($result, $i, 'member_id') . '">Edit</a></td>';
          echo '<td><a href="delete.php?id=' . mysql_result($result, $i, 'member_id') . '">Delete</a></td>';
          echo "</tr>"; 
        }
        // close table>
        echo "</table>"; 
        
        // pagination
        
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