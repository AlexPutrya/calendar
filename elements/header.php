<?php
$pages = [
	['name'=>'Календарь', 'href'=>'index.php?page=calendar', 'page'=>'calendar'],
	['name'=>'Бронирование', 'href'=>'index.php?page=booking', 'page'=>'booking'],
	['name'=>'Клиенты', 'href'=>'index.php?page=clients', 'page'=>'clients']
];
$page = !empty($_GET['page']) ? $_GET['page'] : "";
?>
<header>
	<div class="navbar">
	  <div class="navbar-inner">
	    <a class="brand" href="#">RoomManager</a>
	    <ul class="nav">
	    	<?php
	    	foreach ($pages as $value) {
	    		if($value['page'] == $page){
	    			echo "<li class='active'><a href='{$value['href']}'>{$value['name']}</a></li>";
	    		}else{
	    			echo "<li><a href='{$value['href']}'>{$value['name']}</a></li>";
	    		}		
	    	}
	    	?>
	    	<li><a href="index.php?auth=exit">Выйти</a></li>
	    </ul>
	  </div>
	</div>
</header>