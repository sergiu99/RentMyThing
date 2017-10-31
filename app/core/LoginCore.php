<?php
class LoginCore{
	public static function login($username, $password){
		$user = Controller::model('User');
		$users = $user->where('email','=',$username)->get();
		
		if(isset($users[0])){
			if(password_verify($password, $users[0]->password)){
				$_SESSION['username'] = $username;
				$_SESSION['userID'] = $users[0]->ID;
			}
		}
	}
	
	public static function isLoggedIn(){
		return isset($_SESSION['username']);
		console.log("you are being checked if logged in");
	}
	
	public static function logout(){
		unset($_SESSION['username']);
		unset($_SESSION['userID']);
	}

	public static function getUser(){
		return $_SESSION['userID'];
	}
}
?>