<?php

class Items extends Controller{

	function index(){
		$aItem = $this->model('Item');
		$userId =  $_SESSION['userID'];
		$myItems = $aItem->where('user_id','=',$userId)->getDisplayInfo();
		$this->view('Items/index',['items'=>$myItems]);
	}

	function newItem(){
		if(isset($_POST['action'])){
		$newItem = $this->model('Item');
		
		$userId =  $_SESSION['userID'];
		
		$newItem->user_id = $userId;
		$newItem->status = 'enabled';
		$newItem->name = $_POST['name'];
		$newItem->description = $_POST['description'];
		$newItem->price = $_POST['price'];
		$newItem->category = $_POST['category'];
		$newId = $newItem->insert();
		
		$newItem = $this->model('Item');
		$newItem->id = $newId;
		$newItem->user_id = $userId;
		$newItem->name = $_POST['name'];
		$newItem->description = $_POST['description'];
		$newItem->category = $_POST['category'];
		$newItem->price = $_POST['price'];
		$newItem->status = 'enabled';
		$newItem->image_path = $this->uploadImage($_FILES["fileToUpload"], $newId);
		$newItem->update();
		header("location:/Items");
		} else {
			
			$category = $this->model('Category');
		    $category = $category->get();
			
			
			$this->view('Items/createItem',['category'=>$category ]);
		}
	}

	function editItem($id){
		if(isset($_POST['action'])){
		$newItem = $this->model('Item');
		
		$userId =  $_SESSION['userID'];

         // ** TO WORK ON IT
		//if($userId == $_POST['user_id']){
		$newItem = $newItem->find($id);

		$newItem->user_id = $userId;
		$newItem->status = 'enabled';
		$newItem->name = $_POST['name'];
		$newItem->description = $_POST['description'];
		$newItem->price = $_POST['price'];
		$newItem->category = $_POST['category'];
		if($_FILES['fileToUpload']['size'] != 0){
			$newItem->image_path = $this->uploadImage($_FILES["fileToUpload"], $id);
		}
		$newItem->update();
	//}
		header("location:/Items");
		} else {
			$aItem = $this->model('Item');
		    $aItem = $aItem->find($id);
			
			$category = $this->model('Category');
		    $category = $category->get();
			
			$this->view('Items/editItem',['item'=>$aItem, 'category'=>$category ]);
		}
	}


	function viewItem($id){
		$aItem = $this->model('Item');
		$aItem = $aItem->find($id);
		if($aItem->name !=''){
		$this->view('Items/viewItem',['item'=>$aItem]);
		} else { header("location:/Items");}

	}
	
	function delete($id){
		$aItem = $this->model('Item');
		$aItem = $aItem->find($id);
		$aItem->delete();
		header("location:/Items");
	}

	function setStatus(){
	   $id = intval( $_GET['itemId'] );
	   $status = $_GET['status'];
	   $anItem = $this->model('Item');
	   return $anItem->setStatus($id, $status);
   }

   function search(){
	   $keyword = $_POST['keyword'];
	   $keyword = "%" . $keyword . "%";
	   $anItem = $this->model('Item');
	   $searchItems1 = $anItem->where('t1.name', 'LIKE', $keyword)->getDisplayInfo();
	   $this->view('Items/index',['items'=>$searchItems1]);
   }

	function uploadImage($theFile, $id){
		$target_dir = "images/";	//the folder where files will be saved
		$allowedTypes = array("jpg", "png", "jpeg", "gif", "bmp");// Allow certain file formats
		$max_upload_bytes = 50000000;
			$uploadOk = 1;
			if(isset($theFile)) {
				//Check if image file is a actual image or fake image
				//this is not a guarantee that malicious code may be passed in disguise
				$check = getimagesize($theFile["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
				$extension = strtolower(pathinfo(basename($theFile["name"]),PATHINFO_EXTENSION));
				//give a name to the file such that it should never collide with an existing file name.
				$target_file_name = $id . '.' . $extension;	
				$target_path = $target_dir . $target_file_name;
				//NOTE: that this file path probably should be saved to the database for later retrieval
		
				//It is very unlikely given the naming scheme that another file of the same name will exist... 
				// Check if file already exists
				/*if (file_exists($target_path)) {
					echo "Sorry, file already exists.";
					$uploadOk = 0;
				}*/
		
				//You may limit the size of the incoming file... Check file size
				if ($theFile["size"] > $max_upload_bytes) {
					echo "Sorry, your file is too large.";
					$uploadOk = 0;
				}
		
				// Allow certain file formats
				if(!in_array($extension, $allowedTypes)) {
					echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					$uploadOk = 0;
				}
		
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.";
				} else {// if everything is ok, try to upload file - to move it from the temp folder to a permanent folder
					if (move_uploaded_file($theFile["tmp_name"], $target_path)) {
						echo "The file ". basename( $theFile["name"]). " has been uploaded as <a href='$target_path'>$target_path</a>.";
						return 'images/' . $id . '.' . $extension;
					} else {
						echo "Sorry, there was an error uploading your file.";
					}
				}
			}

		return $target_dir . 'noimage.png';
	}
}
?>