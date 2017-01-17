<?php
class Booking{
	// Класс управления бронированием
	// создание брони
	// изменение брони
	// удаление брони

	private $database;
	private $booking_number;

	public function __construct(){
		$this->database = new DB();
	}

	public function generateBookingNumber(){
		// Генерим случайное число
		$booking_number = rand(0,99999999);
		$sql = 'SELECT id_booking FROM booking';
		$result = $this->database->get($sql);
		$numbers_list = array();
		// Массив с всеми номерами брони
		while($row = $result->fetch()){
			$number_list[] = $row['id_booking'];
		}
		// Генерм новый номер до тех пор, пока не перестанет совпадать с номерами в массиве
		while($i=1){
			if(in_array($booking_number, $numbers_list)){
				$booking_number = rand(0,99999999);
			}else{
				break;
			}
		}
		$this->booking_number = $booking_number; 
		return $booking_number;
	}
	// Создаем бронирование и записывваем в БД
	public function addBooking($data){
		$post_data = array();//Массив с данными из POST
		foreach($data as $key=>$value){
			$post_data[$key] = htmlspecialchars(trim($value));
			if($key == "client_patronymic" OR $key == "client_email"){
				continue;
			}elseif(empty($value)){
				return $message = "Все поля отмеченные * должны быть заполненны"; 
			}
		}
		return $message = "ОК";
	}
}