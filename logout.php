<?php

	setcookie('user_name', '', time()-3600);
	setcookie('user_id', '', time()-3600);
	setcookie('manager_name', '', time()-3600);
		
	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
	header('Location: ' . $home_url);



?>