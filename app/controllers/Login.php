<?php
class Login extends Controller{
	public function index(){
		$user = $this->model('User');
		if(isset($_POST['action']) && $_POST['action'] == 'Login'){

			$email = $_POST['email'];
			$password = $_POST['password'];
			LoginCore::login($email, $password);
			header('location:/Items/');
		}else
			$this->view('Login/index');
	}


	public function signup(){
		$user = $this->model('User');
		if(isset($_POST['action'])){
			$user->first_name = $_POST['first_name'];
			$user->last_name = $_POST['last_name'];
			$user->email = $_POST['email'];
			$user->display_name = $_POST['display_name'];
			$user->password = password_hash($_POST['password'],PASSWORD_DEFAULT);
			$user->phone_number = $_POST['phone_number'];
			$user->street_address = $_POST['street_address'];
			$user->city_address = $_POST['city_address'];
			$user->postal_code_address = $_POST['postal_code_address'];
			$user->province_address = $_POST['province_address'];
			$user->account_status = 'active';
			$user->insert();

			
			header('location:/Login');
		}else
			$this->view('Login/signup');
	}

	
	public function logout(){
		LoginCore::logout();
		header('location:/Login');
	}

	function checkUsername(){
		$nameValue = $_GET['value'];
		$aUser = $this->model('User');
		$userWithName = $aUser->search($nameValue);
		echo sizeOf($userWithName);
	}
}
?>