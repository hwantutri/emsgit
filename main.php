<?php
session_start();
include_once 'class_login.php';
include_once 'scratch.php';
$login = new Login();
$uid = $_SESSION['uid_new'];

if(!$login->get_session()){
	header("location:login.php");
}
if($_GET['q'] == 'logout'){
	$login->logout();
	header("location:login.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<p align="right"><font size="2" color="white">You are logged in as </font><font size="2" color="blue"> <u> <?php $login->get_name($uid);?></u>&nbsp;|&nbsp; <a href="?q=logout"> Log out </a>&nbsp&nbsp;</font></p>
<h1><b><font color="white">MAGNUM Computer Sales and Services</font></b></h1>
	<title>MAGNUM | Main</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="./images/link.png" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="style/flexigrid.css" />
	<link rel="stylesheet" media="screen" type="text/css" href="style/datepicker.css" />
	<link rel="stylesheet" href="style/ui.tabs.css" type="text/css" media="print, projection, screen">
	<link rel="stylesheet" href="style/tests.css" type="text/css" media="screen" charset="utf-8">
	<link type="text/css" href="css/jquery-ui-1.8.5.custom.css" rel="Stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/style2.css" />
	<style type="text/css" media="screen, projection">
	div.tabpanel {
		margin: 0px;
	}
	div.tabcontainer {
		margin: 10px;
	}
	div.tablecontainer {
		margin: 10px;
	}
	body {
		padding: 0;
		margin: 0;
		background: #f8f7e5 url(images/main.jpg) repeat center top;
		width: 100%;
		display: table;
	}
	h1 {
		color: #333333;
		font-family: Gill Sans / Gill Sans MT, sans-serif;
		font-size: 14pt;
		padding-top: 12px;
		padding-bottom: 3px;
	}
        </style>
		<script src="./js/jquery-1.7.2.min.js" type="text/javascript"></script>
		<script src="./js/jquery.js" type="text/javascript"></script>
		<script src="./js/paging.js" type="text/javascript"></script>
        <script src="./js/ui.core.js" type="text/javascript"></script>
        <script src="./js/ui.tabs.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="./themes/jqpurr.css" />
		<script type="text/javascript" src="./js/datepicker.js"></script>
		<script type="text/javascript" src="./js/flexigrid.pack.js"></script>
		<script type="text/javascript" src="./js/jquery.dropshadow.js"></script>
		<script type="text/javascript" src="./js/jquery.purr.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css"/>
		<script type="text/javascript" src="./js/jquery.autocomplete.js"></script>
		<script type="text/javascript" src="./js/custom.js"></script>
	
	<!--includes all jquery scripts-->
    <script type="text/javascript" src="./js/document.ready.js"></script>


</head>
<body>
		<div id="container-1" class="tabcontainer">
        <!--<div id="tabs">-->
            <ul>
				<li><a href="#ems"><span>Home</span></a></li>
                <li><a href="#assignments"><span>Assignments</span></a></li>
                <li><a href="#status"><span>Status</span></a></li>
                <li><a href="#assign"><span>Assign</span></a></li>
				<li><a href="#report"><span>Reports</span></a></li>
            </ul>
		</div>
		<div id="ems">
			<h2>Welcome <font color="blue"><i><?php $login->get_name($uid); ?></i></font>!</h2>
                <p>&nbsp&nbsp&nbsp;The <b>MAGNUM Employee Management System</b> will be able you to do the following tasks:
			<ul>
				<li><b>Assignments	:</b> Add new assigments.</li>
				<li><b>Status	:</b>  View assignment and service crew current status. </li>
				<li><b>Assign	:</b> Assign available assignments to service crew.</li>
				<li><b>Reports	:</b> Generate printable PDF copy.</li>
			</ul>
				</p>
		</div>
		
            <div id="assignments">
	        <h2>Add New Assignments</h2>
				<div class="tablecontainer">
					<form>
						<table border="0">
							<tr>
								<td>Date</td>
								<td>:</td>
								<td><input type="text" id="wdate"  class="wdate" name="wdate" value='<?php echo date("Y-m-d"); ?>'  />(required)</td>
							</tr>
							<tr>
								<td>Time</td>
								<td>:</td>
								<td><input type="text" name="wtime" id="wtime" value="00:00:00"/>(blank for anytime, 24-hour format)</td>
							</tr>
							<tr>
								<td>Description</td>
								<td>:</td>
								<td><input type="text" id="wdesc"  class="wdesc" name="wdesc" autofocus/>(required)</td>
							</tr>
							<tr>
								<td>Client</td>
								<td>:</td>
								<td><input type="text" name="client" id="client"/>(required)</td>
							</tr>
							<tr>
								<td></td><td></td>
								<td><input type="submit" style="margin: 20px 0 0 0;"  class="button" name="submitbtn" id="submitbtn" value="   Submit   " /></td>
							</tr>
						</table>
					</form>
					<br />
				</div>
            </div>
		   
            <div id="status" >
			<div id="nestedtab">
					<ul>
                		<li><a href="#assignstat"><span>Assignment</span></a></li>
                		<li><a href="#crewstat"><span>Service Crew</span></a></li>
					</ul>
				</div>
				<div id="assignstat">
				<div class="tablecontainer">
					<h2>Assignment Status</h2>
						<table id="show" style="display:none"></table>
				</div>
				</div>
				<div id="crewstat">
				<div class="tablecontainer">
					<h2>Service Crew Status</h2>
						<table id="show1" style="display:none"></table>
				</div>
				</div>
			</div>
			
            <div id="assign">
				<div class="tablecontainer">
					<h2>Assign to Service Crew</h2>
					<form>
							<table border="0">
								<tr>
								<label>
									<td>Enter Crew ID</td>
									<td>:</td>
								</label>
									<td>
										<input type="text" id="crewid" name="crewid"/>
									</td>	
								</tr>
								<tr>
								<label>
									<td>Enter Assignment Name</td>
									<td>:</td>
								</label>
									<td>
										<input type="text" id="auto" name="auto"/>
									</td>
								</tr>
								<tr>
									<td></td><td></td>
									<td>
										<input type="submit" style="margin: 20px 0 0 0;" class="button" id="submitbutton" name="submitbutton" value="    Assign    " />
									</td>
								</tr>
							</table>
						</form>
				</div>
			</div>
			
			 <div id="report">
					<div id="nestedtab">
					<ul>
                		<li><a href="#assignrep"><span>Assignment</span></a></li>
                		<li><a href="#crewrep"><span>Service Crew</span></a></li>
					</ul>
					</div>
					<div id="assignrep">
					<div class="tablecontainer">
					<h2>Generate Assignments Report</h2>
					<form action="pdfpreview2.php" method="post">
							<table border="0">
								<tr>
								<label>
									<td>Select an option</td>
									<td>:</td>
								</label>
									<td>
										<select name="statusselect">
											<option selected></option>
											<option value="AVAILABLE">Available</option>
											<option value="ASSIGNED">Assigned</option>
											<option value="all">All</option>
										</select>
									</td>	
								</tr>
								<tr>
									<td></td><td></td>
									<td>
										<input type="submit" style="margin: 20px 0 0 0;" class="button" id="genbutton" name="submitbutton" value="    Generate    " />
									</td>
								</tr>
							</table>
						</form>
					</div>
					</div>
					<div id="crewrep">
					<div class="tablecontainer">
					<h2>Generate Crew Workload Report </h2>
					<form action="pdfpreview.php" method="post">
							<table border="0">
								<tr>
								<label>
									<td>Enter Crew ID</td>
									<td>:</td>
								</label>
									<td>
										<input type="text" id="crewid2" name="crewid2"/>
									</td>	
								</tr>
								<tr>
									<td></td><td></td>
									<td>
										<input type="submit" style="margin: 20px 0 0 0;" class="button" id="genbutton" name="submitbutton" value="    Generate    " />
									</td>
								</tr>
							</table>
						</form>
					</div>
					</div>
			</div>
</body>
</html>