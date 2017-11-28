<?php

class Comment extends Model{
	public $content;
	public $rental_id;
	public $rating;
	public $poster_status;
	public function __construct(){
		parent::__construct();
	}
	
	function isValid(){
		return ($this->content!='' && $this->rental_id != '');
	}
}
?>