<?php
include 'database.php';

$db = new Database();

$crid = $_GET['crid'];
$crid = mysql_escape_string($crid);

$string = 'g';
$sql = "select * from crew where cid='$crid'";
$result = mysql_query($sql);
$total = mysql_num_rows($result);

if($total==1){$string='genesis';}
echo $string;
?>