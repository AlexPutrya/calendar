<?php
$buildings = new Buildings();
// $rooms = new Rooms();
// $rooms_list = $rooms->getList();
$buildings_list = $buildings->getList();//Список зданий

if(!empty($_POST['building_name'])){
	$building_name = htmlspecialchars(trim($_POST['building_name']));
	$message = $buildings->createBuilding($building_name);
}
?>
<?php if(!empty($message)){	echo "<div class='alert alert-success'>$message</div><br>";} ?>
<!-- Блок списка зданий и создания новых -->
<div class="span5" id="buildings">
	<h2>Новое здание</h2>
	<form name="new_build" action="" method="POST">
	Название здания<br>
	<input type="text" name="building_name"><br>
	<button type="submit" class="btn btn-success"> <i class="icon-ok-circle"></i> Создать</button>
</form>
</div>

<!-- Блок списка комнат и создания новых -->
<div class="span5" id="rooms">
	<h2>Новый номер</h2>
	<form name="new_room" action="" method="POST">
	Здание <br>
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
	<button type="submit" class="btn btn-success"> <i class="icon-ok-circle"></i> Создать</button>
</form>
</div>