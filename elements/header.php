<?php
$pages = [
	['name'=>'Календарь', 'href'=>'index.php?page=calendar', 'page'=>'calendar', 'icon'=>'icon-calendar'],
	['name'=>'Бронирование', 'href'=>'index.php?page=booking', 'page'=>'booking', 'icon'=>'icon-plus'],
	['name'=>'Клиенты', 'href'=>'index.php?page=clients', 'page'=>'clients', 'icon'=>'icon-user']
];
$page = !empty($_GET['page']) ? $_GET['page'] : "calendar";
?>
<header>
	<div class="navbar">
	  <div class="navbar-inner">
	    <a class="brand" href="#">RoomManager</a>
	    <ul class="nav">
	    	<?php
	    	foreach ($pages as $value) {
	    		$name = $value['name'];
	    		$href = $value['href'];
	    		$icon = $value['icon'];
	    		if($value['page'] == $page){
	    			echo "<li class='active'><a href='{$href}'><i class='{$icon}'></i> {$name}</a></li>"; 
	    		}else{
	    			// echo "<li><a href='{$value['href']}'>{$value['name']}</a></li>";
	    			echo "<li><a href='{$href}'><i class='{$icon}'></i> {$name}</a></li>";
	    		}		
	    	}
	    	?>
	    	<li><a href="index.php?auth=exit"><i class="icon-off"></i> Выйти</a></li>
	    </ul>
	  </div>
	</div>
</header>