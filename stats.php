<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Title goes here</title>
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
<p><strong>Attendance Form</strong><br>
</div>
</div>
<div class="row2">
  <div class="members_listing">

    <?php
       include_once 'config.php';
       $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to Server: " . mysql_error()); 
       $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to DB " . mysql_error()); 
       
        echo "<form action='' method='post'>";
        echo "<label>Please Enter the date in which you want to view or mark Attendance </label>";
        echo "<input type='date' name='attendance_date' required />";
        echo "<input type='submit'  name='submit' /> * Please Submit date first if the first selected date is wrong then Submit Attendance";
        echo "</form>";


        if(isset($_POST['submit'])){
          $result_zones = mysql_query("SELECT * FROM zones where church_id = '$_SESSION[church_id]'") or die(mysql_error());            
          $zones = array();
          while($row = mysql_fetch_array( $result_zones ))
          {
            array_push($zones, array($row['id'], $row['zonename']));
          }
          function zonename($ar, $id)
          {
            for($i=0; $i<sizeof($ar); $i++){
              if($ar[$i][0] == $id)
              {
                return $ar[$i][1];
              }
            }
            return "";
          }
          $date = $_POST['attendance_date'];
          $result1 = mysql_query("SELECT Members.zone_id as zone_id, COUNT(Members.member_id) as no_cnt FROM `Members` join `Attendance` on Members.church_id=Attendance.church_id AND Members.member_id=Attendance.member_id AND Attendance.date='$date' AND Members.church_id='$_SESSION[church_id]' GROUP BY Members.zone_id ORDER BY Members.dob") or die(mysql_error());            
          while($row1 = mysql_fetch_array( $result1 ))
          { 
            echo "Zone ::" . zonename($zones, $row1['zone_id']) . "COUNT :: " . $row1['no_cnt'] . "<br/><br/>";
          }
          $result2 = mysql_query("SELECT Members.zone_id as zone_id, COUNT(*) as no_cnt FROM Members where church_id='$_SESSION[church_id]' GROUP BY Members.zone_id") or die(mysql_error());            
          while($row2 = mysql_fetch_array( $result2 ))
          {
            echo "Zone ::" . zonename($zones, $row2['zone_id']) . "TOTALCOUNT :: " . $row2['no_cnt'] . "<br/><br/>";
          }
          $result3 = mysql_query("SELECT Members.zone_id as zone_id, COUNT(Members.member_id) as no_cnt FROM `Members` join `Attendance` on Members.church_id=Attendance.church_id AND Members.member_id=Attendance.member_id AND Attendance.date='$date' AND Members.church_id='$_SESSION[church_id]' AND TIMESTAMPDIFF(YEAR,Members.dob,CURDATE())<=12  GROUP BY Members.zone_id ORDER BY Members.dob") or die(mysql_error());            
          while($row3 = mysql_fetch_array( $result3 ))
          { echo "KIDS LESS THAN 12 Years <br/><br/>";
            echo "Zone ::" . zonename($zones, $row3['zone_id']) . "COUNT :: " . $row3['no_cnt'] . "<br/><br/>";
          }
          $result4 = mysql_query("SELECT Members.zone_id as zone_id, COUNT(*) as no_cnt from Members where church_id='$_SESSION[church_id]' AND  TIMESTAMPDIFF(YEAR,Members.dob,CURDATE())<=12  GROUP BY Members.zone_id") or die(mysql_error());            
          while($row4 = mysql_fetch_array( $result4 ))
          { echo "NO OF KIDS LESS THAN 12 Years <br/><br/>";
            echo "Zone ::" . zonename($zones, $row4['zone_id']) . "TOTALCOUNT :: " . $row4['no_cnt'] . "<br/><br/>";
          }
          $result5 = mysql_query("SELECT Members.zone_id as zone_id, COUNT(Members.member_id) as no_cnt FROM `Members` join `Attendance` on Members.church_id=Attendance.church_id AND Members.member_id=Attendance.member_id AND Attendance.date='$date' AND Members.church_id=1 AND TIMESTAMPDIFF(YEAR,Members.dob,CURDATE()) BETWEEN 12 AND 24 GROUP BY Members.zone_id ORDER BY Members.dob") or die(mysql_error());            
          while($row5 = mysql_fetch_array( $result5 ))
          { echo "TEENS 12 - 24 Years <br/><br/>";
            echo "Zone ::" . zonename($zones, $row5['zone_id']) . "COUNT :: " . $row5['no_cnt'] . "<br/><br/>";
          }
          $result6 = mysql_query("SELECT Members.zone_id as zone_id, COUNT(*)  as no_cnt from Members where church_id='$_SESSION[church_id]' AND  TIMESTAMPDIFF(YEAR,Members.dob,CURDATE()) BETWEEN 12 AND 24  GROUP BY Members.zone_id") or die(mysql_error());            
          while($row6 = mysql_fetch_array( $result6 ))
          { echo "NO OF TEENS 12 - 24 Years <br/><br/>";
            echo "Zone ::" . zonename($zones, $row6['zone_id']) . "TOTALCOUNT :: " . $row6['no_cnt'] . "<br/><br/>";
          }
          $result7 = mysql_query("SELECT Members.zone_id as zone_id, COUNT(Members.member_id) as no_cnt  FROM `Members` join `Attendance` on Members.church_id=Attendance.church_id AND Members.member_id=Attendance.member_id AND Attendance.date='$date' AND Members.church_id=1 AND TIMESTAMPDIFF(YEAR,Members.dob,CURDATE())>24 GROUP BY Members.zone_id ORDER BY Members.dob") or die(mysql_error());            
          while($row7 = mysql_fetch_array( $result7 ))
          { echo "PEOPLE WITH AGE GREATER THAN 24 YEARS <br/><br/>";
            echo "Zone ::" . zonename($zones, $row7['zone_id']) . "COUNT :: " . $row7['no_cnt'] . "<br/><br/>";
          }
          $result8 = mysql_query("SELECT Members.zone_id as zone_id, COUNT(*) as no_cnt  from Members where church_id='$_SESSION[church_id]' AND  TIMESTAMPDIFF(YEAR,Members.dob,CURDATE())>24 GROUP BY Members.zone_id") or die(mysql_error());            
          while($row8 = mysql_fetch_array( $result8 ))
          { echo "NO OF PEOPLE WITH AGE GREATER THAN 24 YEARS <br/><br/>";
            echo "Zone ::" . zonename($zones, $row8['zone_id']) . "TOTALCOUNT :: " . $row8['no_cnt'] . "<br/><br/>";
          }


        }
        else
        {
          echo "danile";
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