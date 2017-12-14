<?php
class Profile extends Controller{
	//View the logged in user's profile
	function index(){
		$aUser = $this->model('User');
		$thisUser = $aUser->find($_SESSION['userID']);
		
		$this->view('Profile/index',['user'=>$thisUser]);
	}

	//Validate the profile edit inputs
	function validateProfileChanges(){
		if(isset($_POST)){
			$_SESSION['errors'] = []; //Reset the form errors
			$aUser = $this->model('User');
			$thisUser = $aUser->find($_SESSION['userID']);
		  	if (empty($_POST['email'])) {
			  	$_SESSION['errors']['email'] = "Email is missing";
			}

			if (empty($_POST['city_address'])) {
				$_SESSION['errors']['city_address'] = "City is missing";
			}
	   
			//Check thate the new display name is unique
			if($_POST['display_name'] != $thisUser->display_name && $_POST['display_name'] != ""){
				$userWithName = $aUser->where('display_name', '=', $_POST['display_name'])->get();
				if(sizeOf($userWithName) > 0){
					$_SESSION['errors']['display_name'] = "This display name is already associated to an account";
				}
			}

			//Check that the new email is unique
			if($_POST['email'] != $thisUser->email){
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

			//Validate the new password
			if($_POST['old_password'] != ""){
				//Get the current password
				$password_hash = $thisUser->password;
				//Check that the current password is valid
				if(password_verify($_POST['old_password'], $password_hash)){
					if($_POST['new_password'] != ""){
						//Check that the new passwords match
						if($_POST['new_password'] != $_POST['confirm_password']){
							$_SESSION['errors']['confirm_password'] = "Password confirmation does not match";
						}
					}else{
						$_SESSION['errors']['new_password'] = "Enter a new password or empty the Old Password input field";
					}
				}else{
					$_SESSION['errors']['old_password'] = "Invalid password";
				}
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
				$this->save(); //Save the changes
			}
	  	}
	}

	//Save profile information and settings changes
	function save(){
		$updateUser = $this->model('User');
		$updateUser = $updateUser->find($_SESSION['userID']);
		$updateUser->id = $_SESSION['userID'];
		$updateUser->display_name = $_POST['display_name'];
		$updateUser->first_name = $_POST['first_name'];
		$updateUser->last_name = $_POST['last_name'];
		$updateUser->email = $_POST['email'];
		$updateUser->phone_number = $_POST['phone_number'];
		$updateUser->street_address = $_POST['street_address'];
		$updateUser->account_status = 'active';
		$updateUser->city_address = $_POST['city_address'];
		$updateUser->province_address = $_POST['province_address'];
		$postalCodeExplode = explode(" ", $_POST['postal_code_address']);
		$updateUser->postal_code_address = implode($postalCodeExplode);
		$updateUser->join_date = $_POST['join_date'];

		//Set privacy preferences
		if($_POST['show_phone'] == "true"){
			$updateUser->show_phone = 1;
		}else{
			$updateUser->show_phone = 0;
		}

		if($_POST['show_email'] == "true"){
			$updateUser->show_email = 1;
		}else{
			$updateUser->show_email = 0;
		}

		if($_POST['show_address'] == "true"){
			$updateUser->show_address = 1;
		}else{
			$updateUser->show_address = 0;
		}

		if($_POST['old_password'] != ""){ 
			$updateUser->password = password_hash($_POST['new_password'],PASSWORD_DEFAULT); //Update the password
		}

		$updateUser->update();
		echo json_encode(true); //Confirm that the profile was edited
	}

	//Search for a user by keyword
	function search(){
		$keyword = $_GET['keyword'];
		$aUser = $this->model('User');
		$searchUsers = $aUser->search($keyword);
		$aCategory = $this->model('Category');
		$categories = $aCategory->get();
		$this->view('Profile/search',['users'=>$searchUsers, 'categories'=>$categories, 'keyword'=>$keyword, 'type'=>"Users"]);
	}

	//View a user profile
	function viewUser($id){
		$aUser = $this->model('User');
		$theUser = $aUser->find($id);
		//Check that the user account is active
		if($theUser != false && $theUser->account_status == "active"){
			$anItem = $this->model('Item');
			$userListings = $anItem->where('user_id','=',$id)->where('status', '=', 'enabled')->getDisplayInfo();
			$aFavorite = $this->model('Favorite');
			$userFavorites = $aFavorite->getUserFavoritesId(); //Get the logged in user's favorites
			$favoritesIds = [];
			for($item = 0; $item < sizeOf($userFavorites); $item++){
				$favoritesIds[$item] = $userFavorites[$item]->item_id;
			}
			$this->view('Profile/viewUser',['user'=>$theUser, 'listings'=>$userListings, 'favorites'=>$favoritesIds]);
		}else{
			header("location:/Listings");
		}
	}

	//Disable the logged in user's account
	function deleteAccount(){
		if(isset($_POST['description']) && isset($_POST['confirmation'])){
			if($_POST['confirmation'] == 'yes'){
				$updateUser = $this->model('User');
				$updateUser = $updateUser->find($_SESSION['userID']);
				$updateUser->id = $_SESSION['userID'];
				$updateUser->account_status = 'disabled';
				$updateUser->update(); //Update the user status
				$updateUser->clearUserData(); //Delete some user data
				header("location:/Login/logout");
			} else {
				header("location:/Profile");
			}	
		} else { 
			$this->view('Profile/deleteAccount');
		}
	}

	//Create and insert a support ticket
	function contactUs(){
		if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['urgency'])){
			$userId =  $_SESSION['userID'];
			$newItem = $this->model('Ticket');
			$newItem->user_id = $userId;
			$newItem->title = $_POST['title'];
			$newItem->description = $_POST['description'];
			$newItem->urgency = $_POST['urgency'];
			$newItem->status = "open";
			$newId = $newItem->insert();
			header("location:/Listings");
		} else { 
			$this->view('Profile/help');
		}
	}
}
?>