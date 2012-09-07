<?php
session_start();
include('class_login.php');

$login = new Login();
	if($login->get_session()){
		header("location:main.php");
	//	$msg = "hurray!";
	}
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$user = $login->validate($_POST['uname'],$_POST['password']);
		if($user){
		//successful login
		header("location:login.php");
		}else{
		//login failed
		$msg = 'Incorrect username or password';
		}
	}
?>

<html>
  <script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
<link rel="shortcut icon" href="/images/link.png" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<head>
<title>MAGNUM - Employee Management &nbsp&nbsp;|&nbsp&nbsp;Login</title>
</head>

<script type="text/javascript">
// Validation scripts
function check(){
	if((document.loginForm.uname.value=="") | (document.loginForm.password.value=="")){
		alert("All fields are required!");
		return false;
		}
	else
		return true;
}
</script>
<body onload="history.go(+1)" >
<form name="loginForm" method="POST" onsubmit="return check()" >
		<fieldset>
			<legend>Log in</legend>
			<label for="login">Username</label>
			<input type="text" name="uname" placeholder="username"/>
			<div class="clear"></div>
			
			<label for="password">Password</label>
			<input type="password" name="password" placeholder="password"/>		
			<div class="clear"></div>
			<input type="submit" style="margin: 10 0 0 276px;" class="button" name="Submit" value="Log in"/>
		</fieldset></br>
</form>

</body>
</html>
