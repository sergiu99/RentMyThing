<?php

class Ticket extends Model{
	public $title;
	public $description;
	public $user_id;
	public $urgency;
	public $status;
	public function __construct(){
		parent::__construct();
	}
	
	function isValid(){
		return ($this->title!='' && $this->user_id != '');
	}
}
?>