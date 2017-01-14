<?php
class Buildings{
	//Класс управления зданиями 
	// создание редактиврвание удаление получение списка
	private $database;

	public function __construct(){
		$this->database = new DB();
	}

	// Отдаем массив с id и именами зданий
	public function getList(){
		$buildings = array();
		$sql = 'SELECT * FROM buildings';
		$result = $this->database->get($sql);
		
		for($i=0; $row = $result->fetch(); $i++){
			$buildings[$i]['id'] = $row['id_building']; 
			$buildings[$i]['name'] = $row['building_name'];
		}
		return $buildings;
	}
}