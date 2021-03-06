<?php
// Автозагрузка классов по запросу и папки
spl_autoload_register(function($class_name){
	require_once("classes/" . $class_name . ".cl.php");
});
// Стартуем сессию если ее нет и продолжаем если она есть
$session = new Sessions();
// Если приходит модификатор то выти из сайта
if($_GET['auth'] == "exit"){
	$session->logOut();
}
// Заставляем авторизироватся если FALSE
if(!($_SESSION['loggined'])){
		require_once('pages/authorization.php');
		exit();
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="libraries/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet"> 
	<link href="libraries/datepicker/css/datepicker.min.css" rel="stylesheet" type="text/css">
	<title>Document</title>
</head>
<body>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="libraries/bootstrap/js/bootstrap.min.js"></script>
    <script src="libraries/datepicker/js/datepicker.min.js"></script>
	<?php
		// Выводим хедер
		require_once('elements/header.php');
		// Выводим боди в зависимости от запроса
		switch ($_GET['page']) {
			case 'calendar':
				require_once('pages/calendar.php');
				break;
			
			case 'booking':
				require_once('pages/booking.php');
				break;
			
			case 'clients':
				require_once('pages/clients.php');
				break;

			case 'catalogue':
				require_once('pages/catalogue.php');
				break;
			default:
				require_once('pages/calendar.php');
				break;
		}
	?>
	<footer>	
	</footer>
</body>
</html>