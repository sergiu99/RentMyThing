<?php 

class Category extends Model{
	public $name;

	public function __construct(){
		parent::__construct();
	}
	
	function isValid(){
		return ($this->name!='');
	}

}
?>