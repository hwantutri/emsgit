<?php

include 'database.php';
$db = new Database();

	$my_data=$_GET['q'];
	$my_data2 = $_GET['r'];
	if($my_data2 == "phrase"){
	$sql="SELECT wdescription as lol FROM workload WHERE wdescription LIKE '%$my_data%' and wstatus='AVAILABLE' ORDER BY wdescription asc LIMIT 10";
	}
	else if($my_data2 == "phrase2"){
	$sql="SELECT cid as lol FROM crew WHERE cid LIKE '%$my_data%' ORDER BY cid asc LIMIT 10";
	}
	$result = mysql_query($sql);
	if($result)
	{
		while($row=mysql_fetch_array($result))
		{
			echo $row['lol']."\n";
		}
	}
?>
