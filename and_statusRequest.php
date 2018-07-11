<?php

$dbc = mysqli_connect('127.0.0.1', 'root', 'adminadmin', 'rentbook')   //(DB位址, root, root密碼, 資料庫)
		   or die('Error connecting to MySQL server.');	

	mysqli_query($dbc, "SET NAMES UTF8");


$user_id = $_POST['stu_id'];    //HTTP PostMethod 傳值過來的變數取 "stu_id"
$status = $_POST['status'];
//$user_id = '110016025';		
//$status = 1;

$date = date("Ymd",time());

	switch($status){
	
		case 1: 
			$query = "SELECT book_id, name, subject, version, status, image FROM books, record WHERE u_id='$user_id' AND status='4' AND book_id=b_id" ;
			break;

		case 2: 
			$query = "SELECT book_id, name, subject, version, status, image FROM books WHERE  status='2'" ;
			break;

		case 3: 
			$query = "SELECT book_id, name, subject, version, status, image FROM books WHERE  status='3'" ;
			break;

	}
	
	$result = mysqli_query($dbc, $query) or die('Error query database');

	mysqli_close($dbc);

	$books_num = mysqli_num_rows($result);
	$return_ack = array();


	while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){

		// echo print_r($row);

		$row_array['book_id'] = $row['book_id'];
		$row_array['name'] = $row['name'];
		$row_array['subject'] = $row['subject'];
		$row_array['version'] = $row['version'];
		$row_array['image'] = $row['image'];

		array_push($return_ack,$row_array);

	}

	$ack = array('totalNumber'=>$books_num, 'books'=>$return_ack);


	echo json_encode($ack); 

?>