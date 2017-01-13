<?php
class DB{
	private $db_user = 'alex.putrya';
	private $db_pass = 'starwars';
	private $dsn = "mysql:host=localhost;dbname=room";
	private $opt = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		);
	private $pdo;

	public function __construct(){
		$this->pdo = new PDO($this->dsn, $this->db_user, $this->db_pass, $this->opt);
	}
	
	public function get($sql, $parametr = NULL){
		$smtm = $this->pdo->prepare($sql);
		if(!empty($parametr)){
			$smtm->execute($parametr);
		}else{
			$smtm->execute();
		}
		return $smtm->fetch();
	}

	public function set($sql, $parametr = NULL){
		$smtm = $this->pdo->prepare($sql);
		if(!empty($parametr)){
			$smtm->execute($parametr);
		}else{
			$smtm->execute();
		}
	}

	public function modify($sql, $parametr = NULL){
		if(!empty($parametr)){
			$smtm->execute($parametr);
		}else{
			$smtm->execute();
		}
	}

	public function delete($sql, $parametr = NULL){
		if(!empty($parametr)){
			$smtm->execute($parametr);
		}else{
			$smtm->execute();
		}
	}	
}