<?php
class Rooms{
	//Класс управления номерами(комнатами)
	// создание редактиврвание удаление получение списка 
	private $database;

	public function __construct(){
		$this->database = new DB();
	}
	// Отдаем массив с id и именами зданий
	public function getList(){
		$rooms = array();
		$sql = 'SELECT * FROM rooms';
		$result = $this->database->get($sql);
		// Перебираем приходящие данные и формируем список
		for($i=0; $row = $result->fetch(); $i++){
			$rooms[$i]['id'] = $row['id_room']; 
			$rooms[$i]['name'] = $row['room_name'];
			$rooms[$i]['id_building'] = $row['id_building'];
		}
		return $rooms;
	}
}