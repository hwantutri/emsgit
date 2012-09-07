<?php
include_once 'database.php';
$db = new Database();

class Workload{
	private $str;
	public function add_workload($term,$stamp,$client){
		$sql = "insert into workload(wdescription, wclient, wtime) values('$term','$client', '$stamp')";
		$result = mysql_query($sql);
		
		echo $this->str = 'genesis';
	}
}

class Supervisor{
	public function assign_workload($asname,$crid){
		$string = 'g';
		$sql = "select wid, wtime as date from workload where wdescription='$asname' and wstatus='AVAILABLE'";
		$result = mysql_query($sql);
		$total = mysql_num_rows($result);

		if($total==1){
			$row = mysql_fetch_array($result);
			$answer = $row['wid'];
			$answer0 = $row['date'];
			$sql0 = "select distinct workload.wtime as date2 from assignment,workload,crew where assignment.crew_id='$crid' and workload.wid=assignment.assignment_id";
			$result0 = mysql_query($sql0);
		if($result0){
			while($row0 = mysql_fetch_array($result0)){
				$answer1 = $row0['date2'];
				if($answer0==$answer1){
					$status = true;
					$string = 'ge';
				}
				else{
					$status = false;
				}
			}
		}
			if($status==false){
				$sql1 = "insert into assignment(crew_id,assignment_id) values('$crid','$answer')";
				$result1 = mysql_query($sql1);
				if($result1){
					$sql2 = "update workload SET wstatus='ASSIGNED' where wdescription='$asname'";
					$result2 = mysql_query($sql2);
				}
				if ($result2){
					$string='genesis';
				}
			}
		}
		echo $string;
	}
}
?>