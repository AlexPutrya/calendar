<?php
class Sessions{
	public function __construct(){
	session_start();
	}

	public function login(){
		$_SESSION['loggined'] = TRUE; 
		header("Location: /");
	}

	public function logOut(){
		$_SESSION['loggined'] = FALSE;
	}

}