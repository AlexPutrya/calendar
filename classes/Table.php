<?php
class Table{
	private $id_building;
	private $now_calendar;
	private $end_calendar;
	private $database;

	//Ни в коем случае не применять time() и strtotime(now) на прямую в $now_calendar, будут сбои она постоянно меняется
	// В primary_date ложить строку типа 12.10.2017
	public function __construct($id_building, $primary_date){
		$this->id_building = $id_building;
		echo $this->now_calendar  = strtotime("$primary_date");//Начало календаря меткой
		echo $this->end_calendar = $this->now_calendar+86400*29;//Метка последнего дня календаря
		$this->database = new DB();//Пдключаем БД
	}

}