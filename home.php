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
<p><strong>Welcome to the Church Management Software .....</strong><br>
</div>
</div>
<div class="row2">
<div class="section1">
<h2 class="subtitle">What&#8217;s New</h2>
<p><strong>Lorem Ipsum is simply dummy text of the<br>
printing and typesetting industry.</strong><br>
Lorem Ipsum has been the industry's standard<br>
dummy text ever since the 1500s, when an<br>
unknown printer took a galley of type and</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><a href="#" class="more">read more</a></p>
</div>
<div class="section2">
<h2 class="subtitle">Resources</h2>
<p><strong>Lorem Ipsum is simply dummy text of the printing and
typesetting industry.</strong><br>
Lorem Ipsum has been the industry's standard dummy text ever since the
1500s, when an unknown printer took a galley of type and scrambled it
to make a type specimen book. It has survived not only five centuries,
but</p>
<p>&nbsp;</p>
<p><a href="#" class="more">read more</a></p>
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