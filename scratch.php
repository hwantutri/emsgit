<?php

include_once 'database.php';
$db = new Database();

//function runSQL($sql){
//	mysql_query($sql);
//}

abstract class Employee{
	private $address;
	private $name;
	
	//public function checkAuthentication(){}
}
class Supervisor extends Employee{
	private $crid;
	private $work_description;
	private $return_string = 'g';
	//function __construct($return_string){
	//	$this->return_string = $return_string;
	//}
	public function checkCrewId($crid){
		$sql = "select * from crew where cid='$crid'";
		$result = mysql_query($sql);
		$total = mysql_num_rows($result);
			if($total==1){$return_string='genesis';}
	
	echo $return_string;
	}
	
	public function printWorkloadAssignment(){}
	
	public function assignWorkloadTo($work_description,$crid){
		$return_string = 'g';
		//function __construct($return_string){
		//	$this->return_string = $return_string;
		//}
		$sql = "select wid, wtime as date from workload where wdescription='$work_description' and wstatus='AVAILABLE'";
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
					$return_string = 'ge';
				}
				else{
					$status = false;
				}
			}
		}
			if($status==false){
				$sql1 = "insert into assignment(crew_id,assignment_id) values('$crid','$answer')";
				$result1 = mysql_query($sql1);
				if ($result1){
					$sql2 = "update workload SET wstatus='ASSIGNED' where wdescription='$work_description'";
					$result2 = mysql_query($sql2);
				}
				if ($result2){
					$return_string='genesis';
				}
			}
		}
		echo $return_string;
	}
	//public function addAssignment($date,$time,$description,$client){
		//$stamp = $date.' '.$time;
		//$sql = "insert into workload(wdescription,wclient,wtime) values('$description','$client','$stamp')";
	//}
}
class ServiceCrew extends Employee{
	private $assignments;
	private $emailAddress;
	
	public function isAssignedTo(){}
}
class Clerk extends Employee{
	public function stockAvailability(){}
	public function updateStock(){}
}
class Manager extends Employee{
	public function updateStock(){}
	public function stockReport(){}
	public function printStockReport(){}
}
class Name{
	private $name;
	private $id;
}
class Stocks{
	public function updateStock(){}
}
class OrderStock{
	private $stock;
	private $quantity;
}
class Customer{
	private $order;
	private $address;
	
	public function isDone(){}
}
class Workload{
	private $description;
	private $client;
	private $stamp; //date and time
	private $return_string;
	
	public function addWorkload($description,$stamp,$client){
		$sql = "insert into workload(wdescription, wclient, wtime) values('$description','$client', '$stamp')";
		$result = mysql_query($sql);
		
		echo $this->return_string = 'genesis';
	}
	public function assignedTo(){}
	public function isDone(){}
}
?>