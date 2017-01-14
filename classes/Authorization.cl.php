<?php
class Authorization{
	private $database;
	private $session;
	private $user_name;
	Private $user_password;

	public function __construct($name, $password){
		$this->user_name = $name;
		$this->user_password = $password;
		$this->database = new DB();
		$this->session = new Sessions();
	}


	public function auth(){
		$sql = 'SELECT user_pass FROM users WHERE user_login = :name';
		$parametr = array("name" => "$this->user_name");
		$result = $this->database->get($sql, $parametr);
		$row = $result->fetch();
		if(!$row){
			return $message = "Такого пользователя нет";
		}elseif($row['user_pass'] != $this->user_password){
			return $message = "Вы ввели неправильный пароль";
		}else{
			return $this->session->login();
		}
	}
}