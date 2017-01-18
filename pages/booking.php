<?php
$buildings = new Buildings();
// Список зданий
$buildings_list = $buildings->getList();
$rooms = new Rooms();
// Список комнат
$rooms_list = $rooms->getList();
$booking = new Booking();
// Номер брони
$booking_number = $booking->generateBookingNumber();
if(!empty($_POST['id_room'])){
	$message = $booking->addBooking($_POST);
}
?>
<h1>Создание брони</h1>
<?php if(!empty($message)){	echo "<div class='alert alert-success'>$message</div><br>";} ?>
<form action="" method="POST">
	<div class="span3 offset4">
		Номер брони<br>
		<!-- readonly применяем вместо disabled(не передает данные) -->
		<input type="text" name="booking_number"  placeholder="<?php echo $booking_number?>" value="<?php echo $booking_number?>" readonly><br>
		
		Номер комнаты*<br>
		<!-- Перебрать массив из бд с комнатами даного здания -->
		<select name="id_room">
			<?php
			foreach($buildings_list as $building){
				echo "<optgroup label='{$building['name']}'>";
				foreach($rooms_list as $room){
					if($room['id_building'] != $building['id']){
						continue;
					}else{
						echo "<option value='{$room['id']}'>{$room['name']}</option>";
					}
				}
				echo "</optgroup>"; 
			}
			?>
			<option value="1"></option>
		</select><br>
		
		Дата и время заселения*<br>
		<input type='text' class="datepicker-here" data-timepicker="true" data-time-format='hh:ii' name="enter_date" /><br>
		
		Дата и время выселения*<br>
		<input type='text' class="datepicker-here" data-timepicker="true" data-time-format='hh:ii' name="exit_date" /><br>
		
		Количество мест*<br>
		<select name="count_berth" >
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select><br>
		
		Дополнительные места*<br>
		<select name="extra_berth" >
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select><br>

		Статус*<br>
		<select name="status" >
			<option value="1">Забронировано</option>
			<option value="2">Проживание</option>
		</select><br>
	</div>

	<div class="span2 offset1">
		Фамилия*<br>
		<input type="text" name="client_surname"><br>
		Имя*<br>
		<input type="text" name="client_name"><br>
		Отчество<br>
		<input type="text" name="client_patronymic"><br>
		Телефон*<br>
		<input type="text" name="phone"><br>
		Email<br>	
		<input type="text" name="client_email"><br>
		<button type="submit" class="btn btn-success"> <i class="icon-ok-circle"></i> Создать</button>
	</div>
</form>