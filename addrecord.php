<?php
include_once 'database.php';
//include_once 'functions.php';
include_once 'scratch.php';

$db = new Database();
$work = new Workload();

$description = $_POST['wdesc'];

$stamp = strip_tags(substr($_POST['wdate'] . " " .  $_POST['wtime'],0, 100));
$stamp = mysql_escape_string($stamp); 
$stamp = trim($stamp);
$stamp = trim($stamp, "abcdefghijklmnoABCDEFGHIJKLMNO");

$client = strip_tags(substr($_POST['wclient'],0, 100));
$client = mysql_escape_string($client); 
$client = trim($client);

//$work->add_workload($term,$stamp,$client);
$work->addWorkload($description,$stamp,$client);
?>

