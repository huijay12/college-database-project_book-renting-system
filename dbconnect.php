<?php
	$dbc = mysqli_connect('127.0.0.1', 'root', 'adminadmin', 'rentbook')
		   or die('Error connecting to MySQL server.');	

	mysqli_query($dbc, "SET NAMES UTF8");

?>