<h1>Бронирование номера</h1>
<form action="" method="post">
	<div class="span8">
		Номер брони<br> 
		<input type="text" name="booking_number"  placeholder="<?php echo rand(1,999999)?>" disabled><br>
		Номер комнаты<br>
		<!-- Перебрать массив из бд с комнатами даного здания -->
		<select name="id_room">
			<option value="1"></option>
		</select><br>
		Дата заселения<br>
		<input type='text' class='datepicker-here' name="entry_date" /><br>
		время<input class="input-mini" type="text" name="entry_time"><br>
		Дата выселения<br>
		<input type='text' class='datepicker-here' name="exit_date" /><br>
		время<input class="input-mini" type="text" name="exit_time"><br>
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
	<div class="span3">
		ФИО<br>
		<input type="text" name="client_name"><br>
		Телефон<br>
		<input type="text" name="phone_number"><br>
		Email<br>	
		<input type="text" name="email"><br>
	</div>
</form>