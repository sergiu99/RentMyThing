<?php

class Rental extends Model{
	public $id;
	public $user_id;
	public $item_id;
	public $start_date;
	public $end_date;
	public $total;
	public $status;

	public function __construct(){
		parent::__construct();
	}
	
public	function isValid(){
		return ($this->item_id!='' && $this->user_id != '');
	}

}
?>