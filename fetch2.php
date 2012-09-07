<?php

$new = $_GET['new'];

error_reporting(0);
function runSQL($rsql) {
	$hostname = "localhost";
	$username = "root";
	$password = "";

	$dbname   = "ems";	

	$connect = mysql_connect($hostname,$username,$password) or die ("Error: could not connect to database");
	$db = mysql_select_db($dbname);
	$result = mysql_query($rsql) or die ('test'); 
	return $result;
	mysql_close($connect);
}

$total = countRec('crew');

function countRec($tname){
$sql = "SELECT count(*) FROM $tname";
$result = runSQL($sql);
while ($row = mysql_fetch_array($result)) {
return $row[0];
}
}

$page = $_POST['page'];
$rp = $_POST['rp'];
$sortname = $_POST['sortname'];
$sortorder = $_POST['sortorder'];

if (!$sortname) $sortname = 'cname';
if (!$sortorder) $sortorder = 'desc';

$stat = $_POST['query'];

if($_POST['query']!=''){
	$where = "`".$_POST['qtype']."`='".$_POST['query']."' ";
} else {
	$where ='';
}

$sort = "ORDER BY $sortname $sortorder";

if (!$page) $page = 1;
if (!$rp) $rp = 10;

$start = (($page-1) * $rp);

$limit = "LIMIT $start, $rp";

$sql = "select cid, cname, ceadd from crew $sort $limit";
$result = runSQL($sql);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
header("Content-type: text/x-json");
$json = "";
$json .= "{\n";
$json .= "page: $page,\n";
$json .= "total: $total,\n";
$json .= "rows: [";
$rc = false;
while ($row = mysql_fetch_array($result)) {
if ($rc) $json .= ",";
$json .= "\n{";

$json .= "id:'".$row['cid']."',";
$json .= "cell:['".$row['cid']."','".$row['cname']."'";
$json .= ",'".$row['ceadd']."'";
$sql1 = "select * from assignment where crew_id='".$row['cid']."'";
$result1 = runSQL($sql1);
$final = mysql_num_rows($result1);
$json .= ",'".$final."']";
$json .= "}";
$rc = true;
}

$json .= "]\n";
$json .= "}";
echo $json;
?>