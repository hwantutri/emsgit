<?php
include 'database.php';
include 'scratch.php';

$db = new Database();
$check = new Supervisor();

$crid = $_POST['crid'];
$crid = mysql_escape_string($crid);

$check->checkCrewId($crid);

//$string = 'g';
//$sql = "select * from crew where cid='$crid'";
//$result = mysql_query($sql);
//$total = mysql_num_rows($result);

//if($total==1){$string='genesis';}
//echo $string;
?>