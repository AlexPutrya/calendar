<?php
$buildings = new Buildings();
$buildings_list = $buildings->getList();
?>
<!-- Форма запроса вида календаря -->
<form action="" method="POST">
	Здания <br>
	<select name="id_building">
		<?php
		// Выводим список выбора здания
		foreach ($buildings_list as $building){
			echo "<option value='{$building['id']}'>{$building['name']}</option>";
		}
		?>
	</select><br>
	Дата календаря <br>
	<input type='text' class='datepicker-here' name="primary_date" /><br>
</form>

<?php
//Ни в коем случае не применять time() и strtotime(now) будут сбои она постоянно меняется
$now_date = strftime("%d.%m.%Y", strtotime('now'));
$now = strtotime("$now_date");//начало календаря
$end_calendar = $now+86400*29;//Конец календаря 30дней включительно с 1 дня

$rooms_db = array(
	array("id_room" => 1, "room_name" => 'Комната 101'),
	array("id_room" => 2, "room_name" => 'Комната 102'),
	array("id_room" => 3, "room_name" => 'Комната 103'),
	array("id_room" => 4, "room_name" => 'Комната 104'),
	array("id_room" => 5, "room_name" => 'Комната 105')
	);

$booking = array(
	array("id_room" => 1, "start" => "12.01.2017", "end" => "14.01.2017"),
	array("id_room" => 1, "start" => "20.01.2017", "end" => "24.01.2017"),
	array("id_room" => 1, "start" => "28.01.2017", "end" => "18.02.2017"),

	array("id_room" => 2, "start" => "08.01.2017", "end" => "17.01.2017"),
	array("id_room" => 2, "start" => "20.01.2017", "end" => "22.01.2017"),
	array("id_room" => 2, "start" => "26.01.2017", "end" => "05.02.2017"),

	array("id_room" => 3, "start" => "07.01.2017", "end" => "15.01.2017"),
	array("id_room" => 3, "start" => "18.01.2017", "end" => "26.01.2017"),
	array("id_room" => 3, "start" => "28.01.2017", "end" => "03.02.2017")
);
$time_stamps = array();//массив с метками резерва типа array[id_room][timestamp]
// Первичный отбор из БД
// foreach перебор данных из бД
echo "<table class='table' border='1' cellspacing='5'>";
// Перебор строк таблицы
	foreach ($rooms_db as $value) {
		echo "<tr>";
			$id_room = $value['id_room'];
			echo "<td>" . $value['room_name'] . "</td>";
			// Сортировка активных временных меток в другой массив
		foreach ($booking as $rooms) {
			// Фильтруем по каждой комнате
			if($value['id_room'] != $rooms['id_room']){
				continue;
				// Начальная дата больше окончания календаря
			}elseif(strtotime($rooms['start']) > $end_calendar){
				continue;
				// Конечная дата меньше начала календаря
			}elseif(strtotime($rooms['end']) < $now){
				continue;
				// Если даты попадяют в диапазон календаря
			}elseif(strtotime($rooms['start']) >= $now AND strtotime($rooms['end']) <= $end_calendar ){
				$c = strtotime($rooms['start']);
				while($c <= strtotime($rooms['end'])){
					$time_stamps[$id_room][] = $c;
					$c+= 86400;
				}
				// Если попадает только дата выезда
			}elseif(strtotime($rooms['start']) < $now ){
				$i = $now;
				while($i <= strtotime($rooms['end'])){
					$time_stamps[$id_room][] = $i;
					$i+= 86400;
				}
				// Если попадает только дата вьезда
			}elseif(strtotime($rooms['end']) >= $end_calendar ) {
				$b = strtotime($rooms['start']);
				while($b <= $end_calendar){
					$time_stamps[$id_room][] = $b;
					$b+= 86400;
				}
			}
		}
		// Выводим даты если совпадают с метками делаем ячейки цветными,
		// (есть проблема с функцией in_array() при простом массиве работает нормально)
		// но при многомерном дает ошибки но выводит все правильно(поставил заглушку пока)
		$a = $now;
		while($a<=$end_calendar){ 
			if(@in_array($a, $time_stamps[$id_room])){
				echo "<td bgcolor='#ffcc00' width='10px'></td>";
			}else{
				echo "<td width='10px'>   </td>";
			}
			$a+= 86400;
		}
		echo "</tr>";
		}
echo "</table>";
?>