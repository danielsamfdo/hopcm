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
  <title>Attendance</title>
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
<p><strong>Attendance Form</strong><br>
</div>
</div>
<div class="row2">
  <div class="members_listing">

    <?php
       include_once 'config.php';
       $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to Server: " . mysql_error()); 
       $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to DB " . mysql_error()); 
       if(!empty($_POST['attendance_date']))
       {
       		$attendance_date = $_POST['attendance_date'];
       		echo "Attendance on ". $attendance_date;

			$result = mysql_query("SELECT * FROM Members where church_id = '$_SESSION[church_id]' ORDER BY dob asc") or die(mysql_error());         	 
			echo "<form action='attendance_marking.php' method='post'>";
			echo "<input type='hidden' name='attendance_date' value='". $attendance_date ."'>";
      echo "<input type='text' name='event' value='Sunday Service'>";
        	echo "<table>";
        	$i = 1;
			while($row = mysql_fetch_array( $result )) {
		          // echo out the contents of each row into a table
		          echo "<tr>";
		          echo '<td>' . $row['name'] . '</td>';
		          echo '<td>' . $row['gender'] . '</td>';
		          $rslt = mysql_query("SELECT * FROM Attendance where church_id = '$_SESSION[church_id]' AND member_id='$row[member_id]' AND `date`='$attendance_date'")  or die(mysql_error());
		          if (mysql_num_rows($rslt))
		          	{
		          		$check=1;
		          	}
		          else {
		          		$check=0;
		            }
		          $ch_var = $check==1 ? 'checked' : '' ;
		          echo '<td>' . "<input type='checkbox' value='". $row['member_id'] ."' name='present_". $i . "'" . $ch_var ." />" . '</td>';
		          $i++;
		          echo "</tr>"; 
		        } 
		        echo "<input type='hidden' name='count_of_rows' value='" . mysql_num_rows($result) . "' />";
    	    // close table>
	        echo "</table><input type='submit' />";
	       echo "</form>";
       }
       else
       {
        ob_clean();
       	header("Location: attendance_page.php");
       }
        echo "<form action='attendance_page.php' method='post'>";
        echo "<label>Please Enter the date in which you want to view or mark Attendance </label>";
        echo "<input type='date' name='attendance_date' />";
        echo "<input type='submit' /> * Please Submit date first if the first selected date is wrong then Submit Attendance";
        echo "</form>";
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