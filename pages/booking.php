<?php
$buildings = new Buildings();
$buildings_list = $buildings->getList();
$rooms = new Rooms();
$rooms_list = $rooms->getList();
?>
<h1>Создание брони</h1>
<form action="" method="post">
	<div class="span4 offset2">
		Номер брони<br>
		<input type="text" name="booking_number"  placeholder="<?php echo rand(1,999999)?>" disabled><br>
		Номер комнаты<br>
		<!-- Перебрать массив из бд с комнатами даного здания -->
		<select name="id_room">
			<?php
			foreach($buildings_list as $building){
				echo "<optgroup label='{$building['name']}'>";
				foreach($rooms_list as $room){
					if($room['id_building'] != $building['id']){
						continue;
					}else{
						echo "<option value='{$building['id']}/{$room['id']}'>{$room['name']}</option>";
					}
				}
				echo "</optgroup>"; 
			}
			?>
			<option value="1"></option>
		</select><br>
		Дата и время заселения<br>
		<input type='text' class="datepicker-here" data-timepicker="true" data-time-format='hh:ii' name="enter_date" /><br>
		Дата и время выселения<br>
		<input type='text' class="datepicker-here" data-timepicker="true" data-time-format='hh:ii' name="exit_date" /><br>
		Количество мест<br>
		<select name="count_berth" >
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select><br>
		Дополнительные места<br>
		<select name="extra_berth" >
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select><br>
	</div>

	<div class="span4 offset2">
		ФИО<br>
		<input type="text" name="client_name"><br>
		Телефон<br>
		<input type="text" name="phone_number"><br>
		Email<br>	
		<input type="text" name="email"><br>
	</div>
</form>