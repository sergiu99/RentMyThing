<?php

class Notification extends Model{
	public $user_id;
	public $content;
	public $created_on;
	public $redirect;

	public function __construct(){
		parent::__construct();
	}
	
	function isValid(){
		return ($this->firstName!='' && $this->country != '');
	}
}
?>