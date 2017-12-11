<?php
class LoginCore{
	public static function login($username, $password){
		$user = Controller::model('User');
		$users = $user->where('email','=',$username)->where('account_status','=','active')->get();
		
		if(isset($users[0])){
			if(password_verify($password, $users[0]->password)){
				session_start();
				$_SESSION['username'] = $username;
				$_SESSION['userID'] = $users[0]->ID;
				$_SESSION['errors'] = [];
			}
		}
	}
	
	public static function isLoggedIn(){
		return isset($_SESSION['username']);
		console.log("you are being checked if logged in");
	}
	
	public static function logout(){
		$_SESSION['username'] = 'NADA';
		$_SESSION['userID'] = 'NADA';
		unset($_SESSION['username']);
		unset($_SESSION['userID']);
		session_unset(); 
		session_destroy();
		$_SESSION = array();
	}

	public static function getUser(){
		return $_SESSION['userID'];
	}
}
?>