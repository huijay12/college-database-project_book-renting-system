<?php 

	include("dbconnect.php");

	$books = $_REQUEST["books"];

	$num = count($books);

	for($i=0; $i<$num; $i++)
		echo $books[$i] . "<br/>";

?>