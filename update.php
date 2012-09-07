<?php
include 'database.php';
//include_once 'functions.php';
include_once 'scratch.php';

$db = new Database();
$update = new Supervisor();

$asname = strip_tags(substr($_POST['asname'],0, 100));
$asname = mysql_escape_string($asname); 

$crid = $_POST['crid'];
$crid = mysql_escape_string($crid); 

$update->assignWorkloadTo($asname,$crid);
?>