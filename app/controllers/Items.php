<?php

class Items extends Controller{

	//Get all of a user's items
	function index(){
		$aItem = $this->model('Item');
		$userId =  $_SESSION['userID'];
		$myItems = $aItem->where('user_id','=',$userId)->where('status', '<>', 'deleted')->getDisplayInfo(); //get item details
		$this->view('Items/index',['items'=>$myItems]);
	}

	//Create and insert a new item
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
			$newId = $newItem->insert(); //Get the id of the new item to be used as file name
		
			$newItem->id = $newId;
			//Update the item with the image filename, using the new item id
			$newItem->image_path = $this->uploadImage($_FILES["fileToUpload"], $newId);
			$newItem->update();

			//Redirect to the items index
			header("location:/Items");
		} else {
			$category = $this->model('Category');
		    $category = $category->get();
			
			$this->view('Items/createItem',['category'=>$category ]);
		}
	}


	//Update an item 
	//$id The id of the item to be updated
	function editItem($id){
		if(isset($_POST['action'])){
			$newItem = $this->model('Item');
		
			//Get the existing item record
			$userId =  $_SESSION['userID'];
			$newItem = $newItem->find($id);

			//Set the updated item information
			$newItem->user_id = $userId;
			$newItem->status = 'enabled';
			$newItem->name = $_POST['name'];
			$newItem->description = $_POST['description'];
			$newItem->price = $_POST['price'];
			$newItem->category = $_POST['category'];
			//Update the item image if a file has been provided
			if($_FILES['fileToUpload']['size'] != 0){
				$newItem->image_path = $this->uploadImage($_FILES["fileToUpload"], $id);
			}
			$newItem->update();
			header("location:/Items");
		} else {
			$aItem = $this->model('Item');
		    $aItem = $aItem->find($id);
			
			$category = $this->model('Category');
		    $category = $category->get();
			
			$this->view('Items/editItem',['item'=>$aItem, 'category'=>$category ]);
		}
	}
	
	//Delete an item
	//$id The id of the item to be deleted
	function delete($id){
		$aItem = $this->model('Item');
		$aItem = $aItem->find($id);
		$aItem->status = "deleted";
		$aItem->update();
		header("location:/Items");
	}

	//Change the status of an item
	function setStatus(){
	   $id = intval( $_GET['itemId'] );
	   $status = $_GET['status'];
	   $anItem = $this->model('Item');
	   return $anItem->setStatus($id, $status);
   }

   //Search for an item by matching the name to a keyword
   function search(){
	   if(isset($_POST['keyword'])){
			$keyword = $_POST['keyword'];
	   }else{
			$keyword = "";
	   }
	   
	   $keyword = "%" . $keyword . "%";
	   $anItem = $this->model('Item');
	   $searchItems1 = $anItem->where('user_id', '=', $_SESSION['userID'])->where('status', '<>', 'deleted')->where('t1.name', 'LIKE', $keyword)->getDisplayInfo(); //Get the item details
	   $this->view('Items/index',['items'=>$searchItems1]);
   }

   //Upload an image to the database
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

		return $target_dir . 'noimage.png'; //Return the default image if the uploaded file is invalid
	}
}
?>