<?php 

	include("dbconnect.php");

	define('uploadpath', 'images/');


	$name = $_POST['bookname'];
	$version = $_POST['version'];
	$subject = $_POST['subject'];
	$image = $_FILES['bookImg']['name'];

	//設定圖片目的地
	$target = uploadpath . $image;

	//將圖片從tmp資料夾換成我設定的路徑
	move_uploaded_file($_FILES['bookImg']['tmp_name'], $target);  

	$query = "INSERT INTO books VALUES (0, '$name', '$version', '$subject', 1, '$image')";

	mysqli_query($dbc, "SET NAMES UTF8");

	$result = mysqli_query($dbc, $query) 
	           or die('Error query database');

	// echo $_FILES['bookImg']['tmp_name'];

	echo "上架完成";

?>