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

	function validateSignup(){
		if(isset($_POST)){
			$_SESSION['errors'] = [];
			$aUser = $this->model('User');
		  	if (empty($_POST['email'])) {
			  	$_SESSION['errors']['email'] = "Email is missing";
			}

			if (empty($_POST['city_address'])) {
				$_SESSION['errors']['city_address'] = "City is missing";
			}

			if (empty($_POST['postal_code_address'])) {
				$_SESSION['errors']['postal_code_address'] = "Postal Code is missing";
			}

			if (empty($_POST['province_address'])) {
				$_SESSION['errors']['province_address'] = "Province is missing";
			}
	   
			if($_POST['display_name'] != ""){
				$userWithName = $aUser->where('display_name', '=', $_POST['display_name'])->get();
				if(sizeOf($userWithName) > 0){
					$_SESSION['errors']['display_name'] = "This display name is already associated to an account";
				}
			}

			if($_POST['email'] != ""){
				$userWithEmail = $aUser->where('email', '=', $_POST['email'])->get();
				if(sizeOf($userWithEmail) > 0){
					$_SESSION['errors']['email'] = "This email is already associated to an account";
				}
			}
			//check phone # format
			if(!empty($_POST['phone_number']) && preg_match('^[0-9]{3}(-)[0-9]{3}(-)[0-9]{4}$^', $_POST['phone_number']) != 1){
				$_SESSION['errors']['phone_number'] = "Phone number must be in the format 999-999-9999";
			}
			//check postal code format
			if(preg_match('^[A-Z]{1}[0-9]{1}[A-Z]{1}( |)[0-9]{1}[A-Z]{1}[0-9]{1}$^', $_POST['postal_code_address']) != 1){
				$_SESSION['errors']['postal_code_address'] = "Postal code must be in the format A1A 1A1 or A1A1A1";
			}

			if(count($_SESSION['errors']) > 0){
				//This is for ajax requests:
				if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
					echo json_encode($_SESSION['errors']);
					exit;
				}
			  	//This is when Javascript is turned off:
				echo '<ul>';
				foreach($_SESSION['errors'] as $key => $value){
					echo '<li>' . $value . '</li>';
				}
				echo '</ul>'; exit;
			}else{
				$this->signup();
			}
	  	}
	}

	function signup(){
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
			$postalCodeExplode = explode(" ", $_POST['postal_code_address']);
			$user->postal_code_address = implode($postalCodeExplode);
			$user->province_address = $_POST['province_address'];
			$user->account_status = 'active';
			$user->insert();
			
			echo json_encode(true);
		}else{
			$this->view('Login/signup');
		}
	}

	
	function logout(){
		LoginCore::logout();
		header('location:/Login');
	}

	function checkUsername($nameValue){
		$aUser = $this->model('User');
		if(isset($_SESSION['userId'])){
			$thisUser = $aUser->find($_SESSION['userId']);
			if($nameValue != $thisUser->display_name){
				$userWithName = $aUser->where('display_name', '=', $nameValue)->get();
			}else{
				$userWithName = 0;
			}
		}else{
			$userWithName = $aUser->where('display_name', '=', $nameValue)->get();			
		}
		echo sizeOf($userWithName);
	}

	function checkEmail($emailValue) {
		$aUser = $this->model('User');
		if(isset($_SESSION['userId'])){
			$thisUser = $aUser->find($_SESSION['userId']);
			if($emailValue != $thisUser->email){
				$userWithEmail = $aUser->where('display_name', '=', $emailValue)->get();
			}else{
				$userWithEmail = 0;
			}
		}else{
			$userWithEmail = $aUser->where('display_name', '=', $emailValue)->get();			
		}
		$userWithEmail = $aUser->where('email', '=', $emailValue)->get();
		echo sizeOf($userWithEmail);
	}
}
?>