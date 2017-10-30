<?php
class Login extends Controller{
	public function index(){
		
		$this->view('/put/index');
	}
	
	public function tryPut(){
		$dest1 = fopen("put.txt", "w");
		$src = fopen("php://input", "r");
		stream_copy_to_stream($src, $dest1);
	}
}
?> 