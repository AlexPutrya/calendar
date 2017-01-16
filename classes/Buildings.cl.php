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
		// Перебираем приходящие данные и формируем список
		for($i=0; $row = $result->fetch(); $i++){
			$buildings[$i]['id'] = $row['id_building']; 
			$buildings[$i]['name'] = $row['building_name'];
		}
		return $buildings;
	}
	// Создание нового здания
	public function createBuilding($building_name){
		$sql = "INSERT INTO buildings(id_building, building_name)VALUES( :id, :building_name)";
		$parametr =  array("building_name" => "$building_name",
						   "id" => "");
		$this->database->set($sql, $parametr);
		return $message = "Здание успешно добавленно";
	}
}