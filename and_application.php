<?php

include("dbconnect.php");



$userid = $_POST['stu_id'];
$type = $_POST['type'];
$getPost = $_POST['book_id'];

$books = explode(" ",$getPost);

// $userid = '110016000';
// $type = 2;
// $books = array(28, 29);

$num = count($books);

$date = date("Ymd",time());



if($type == 1){

for($i=0; $i<$num; $i++){

		$query = "INSERT INTO record (u_id, b_id, apply_rent_date) VALUES('$userid', $books[$i], '$date')";

		mysqli_query($dbc, $query) or die('Error query database');

		$query = "UPDATE books SET status=2 WHERE book_id=$books[$i]";
		mysqli_query($dbc, $query) or die('Error query database');
}  // end for

echo "1"; 

}//end if



if($type == 2){

for($i=0; $i<$num; $i++){

		$query = "UPDATE record SET apply_back_date='$date' WHERE u_id='$userid' AND b_id=$books[$i]";

		mysqli_query($dbc, $query) or die('Error query database');

		$query = "UPDATE books SET status=3 WHERE book_id=$books[$i]";
		mysqli_query($dbc, $query) or die('Error query database');
}  // end for

echo "1"; 

}//end if





?>