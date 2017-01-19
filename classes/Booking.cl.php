<?php
class Booking{
	// Класс управления бронированием
	// создание брони
	// изменение брони
	// удаление брони

	private $database;
	private $date_helper;

	public function __construct(){
		$this->database = new DB();
		$this->date_helper = new DateHelper();
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
		while(true){
			if(in_array($booking_number, $numbers_list)){
				$booking_number = rand(0,99999999);
			}else{
				break;
			}
		} 
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
		// 0=>дата, 1=>время
		// Получаем время строкой
		$post_data['enter_time'] = explode(" ", $post_data['enter_date'])[1];
		$post_data['exit_time'] = explode(" ", $post_data['exit_date'])[1];
		// Переводим в метку
		$post_data['enter_date'] = strtotime(explode(" ", $post_data['enter_date'])[0]);
		$post_data['exit_date'] = strtotime(explode(" ", $post_data['exit_date'])[0]);

		// 0=> id_building, 1=>id_room
		$post_data['id_building'] = explode("/", $post_data['id_room'])[0]; 
		$post_data['id_room'] = explode("/", $post_data['id_room'])[1];
		$post_data['id_client'] = rand(0, 1000);//Переделать на нормальный с поиском

		$sql1 = "INSERT INTO booking VALUES( :booking_number, :id_room, :id_building, :id_client, :enter_date, :enter_time, :exit_date, :exit_time, :count_berth, :extra_berth, :status)";
		$sql2 = "INSERT INTO clients VALUES( :id_client, :client_name , :client_surname, :client_patronymic, :client_email, :phone)";
		// Выбираем из массива данные для таблицы бронирования
		$parametr1 = array_slice($post_data, 0, 7);
		$parametr1 += array_slice($post_data, -4, 4);
		// Выбираем из массива данные для таблицы клиентов
		$parametr2 = array_slice($post_data, 7, 5);
		$parametr2 += array_slice($post_data, -1, 1);

		// Проверка попадания в диапазон
		if($this->date_helper->inSpan($post_data['id_room'], $post_data['id_building'], $post_data['enter_date'], $post_data['exit_date'])){
			return $message = "Даты в указанном диапазоне заняты";
		}

		// Потом убарать
		// echo "<pre>"; print_r($post_data);
		// echo "<pre>"; print_r($parametr1);
		// echo "<pre>"; print_r($parametr2);
		// exit();

		//Создаем клиента
		$this->database->set($sql2, $parametr2);
		//Создаем бронироваение
		$this->database->set($sql1, $parametr1);
		return $message = "Данные успешно добавлены";
	}
}