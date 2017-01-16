<?php
$buildings = new Buildings();
$buildings_list = $buildings->getList();//Список зданий

if(!empty($_POST['building_name'])){
	$building_name = htmlspecialchars(trim($_POST['building_name']));
	$message = $buildings->createBuilding($building_name);
}
?>
<?php if(!empty($message)){	echo "<div class='alert alert-success'>$message</div><br>";} ?>
<!-- Блок списка зданий и создания новых -->
<div class="span5" id="buildings">
	<form name="new_build" action="" method="POST">
	Название здания<br>
	<input type="text" name="building_name"><br>
	<input type="submit" value="Создать">
</form>
</div>

<!-- Блок списка комнат и создания новых -->
<div class="span5" id="rooms">
	<form name="new_room" action="" method="POST">
	Здания <br>
	<select name="id_building">
		<?php
		// Выводим список выбора здания
		foreach ($buildings_list as $building){
			echo "<option value='{$building['id']}'>{$building['name']}</option>";
		}
		?>
	</select><br>
	Название комнаты<br>
	<input type="text" name="room_name"><br>
	<input type="submit" value="Создать">
</form>
</div>