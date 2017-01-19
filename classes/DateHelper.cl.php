<?php
class DateHelper{
	//Класс проверки диапазона дат, помошник перевода дней недели и календаря
	//Любая работа с датами из БД
	private $database;

	public function __construct(){
		$this->database = new DB();
	}

	 //проверка попадания в диапазон времени
	public function inSpan($id_room, $id_building, $enter_date, $exit_date){
		// Переделать запрос под id_building и id_room
		$sql = "SELECT enter_date, exit_date FROM booking WHERE id_room = :id_room AND id_building = :id_building";
		$parametr = array("id_room" => "$id_room",
						  "id_building" => "$id_building"
						);
		$result = $this->database->get($sql, $parametr);
		while($row = $result->fetch()){
			// Обе даты внутри диапазона или одна из них 
			if($enter_date>$row['enter_date'] && $enter_date<$row['exit_date'] OR $exit_date>$row['enter_date'] && $exit_date<$row['exit_date']){
				return TRUE;
				// Даты поглощают диапазон
			}elseif($row['enter_date']>=$enter_date && $row['enter_date']<$exit_date OR $row['exit_date']>$enter_date && $row['exit_date']<=$exit_date){
				return TRUE;
				// Обе даты равны уже забронированным
			}elseif($row['enter_date']=$enter_date && $row['exit_date']=$exit_date){
				return TRUE;
			}
			return FALSE;
		}
	}
}