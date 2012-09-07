<?php 

include_once 'database.php';

class Login{
	//connect to database
	public function __construct(){
		$db = new Database();
	}
	//login
	public function validate($username,$password){
		$result = mysql_query("select * from supervisor where username='$username' and password='$password'");
		$user_data = mysql_fetch_array($result);
		$no_rows = mysql_num_rows($result);
		if($no_rows == 1){
			$_SESSION['user_new'] = true;
			$_SESSION['uid_new'] = $user_data['id'];
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//getting session
	public function get_session(){
		return $_SESSION['user_new'];
	}
	//getting name
	public function get_name($uid){
	$result = mysql_query("select name from supervisor where id ='$uid' ");
	$user_data = mysql_fetch_array($result);
	echo $user_data['name'];
	}
	//logout
	public function logout(){
		$_SESSION['user_new'] = FALSE;
		session_destroy();
	}
}

?>