<?php

class Profile extends Controller{
	function index(){
		$aUser = $this->model('User');
		$thisUser = $aUser->find($_SESSION['userID']);
		
		$this->view('Profile/index',['user'=>$thisUser]);
	}

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
		$updateUser->postal_code_address = $_POST['postal_code_address'];
		$updateUser->city_address = $_POST['city_address'];
		$updateUser->province_address = $_POST['province_address'];
		$updateUser->postal_code_address = $_POST['postal_code_address'];
		$updateUser->join_date = $_POST['join_date'];

		if(isset($_POST['show_phone'])){
			$updateUser->show_phone = 1;
		}else{
			$updateUser->show_phone = 0;
		}

		if(isset($_POST['show_email'])){
			$updateUser->show_email = 1;
		}else{
			$updateUser->show_email = 0;
		}

		if(isset($_POST['show_address'])){
			$updateUser->show_address = 1;
		}else{
			$updateUser->show_address = 0;
		}

		//TODO match passwords, update password
		if($_POST['old_password'] != ""){
			$password_hash = $updateUser->password;
			if(password_verify($_POST['old_password'], $password_hash)){
				//echo ("correct pass");
				if($_POST['new_password'] != ""){
					if($_POST['new_password'] == $_POST['confirm_password']){
					//	echo "matching pass";
						$updateUser->password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
					}else{
						//echo "pass do not match";
					}
				}else{
					//echo "empty new pass";
				}
			}else{
				//echo "incorrect pass";
			}
		}else{
			//echo "empty pass";
		}

		$updateUser->update();

		$this->index();
	}

	function search(){
		$keyword = $_POST['keyword'];
		$aUser = $this->model('User');
		$searchUsers = $aUser->search($keyword);
		$aCategory = $this->model('Category');
		$categories = $aCategory->get();
		$this->view('Profile/search',['users'=>$searchUsers, 'categories'=>$categories, 'keyword'=>$keyword]);
	}

	function viewUser($id){
		$aUser = $this->model('User');
		$theUser = $aUser->find($id);
		$anItem = $this->model('Listing');
		$userListings = $anItem->where('user_id','=',$id)->getDisplayInfo();
		$this->view('Profile/viewUser',['user'=>$theUser, 'listings'=>$userListings]);
	}

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