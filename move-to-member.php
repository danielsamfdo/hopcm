<?php
/* 
 DELETE.PHP
 Deletes a specific entry from the 'players' table
*/
 session_start();
 // connect to the database
 include_once 'config.php';
 $con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to Server: " . mysql_error()); 
 $db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to DB " . mysql_error()); 
 
 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['id']) && is_numeric($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];
 
 // delete the entry
 $result = mysql_query("Update Members SET newcomer='0' where member_id='$id' AND church_id='$_SESSION[church_id]'") or die(mysql_error()); 
 
 // redirect back to the view page
   header("Location: view.php");
 }
 else
 // if id isn't set, or isn't valid, redirect back to view page
 {
 header("Location: view.php");
 }
 
?>