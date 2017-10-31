<?php

class Item extends Model{
	public $name;
	public $user_id;
	public $description;
	public $image_path;
	public $price;
	public $category;
	public $rating;
	public $status;

	public function __construct(){
		parent::__construct();
	}
	
	function isValid(){
		return ($this->name!='' && $this->user_id != '');
	}

}
?>