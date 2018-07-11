<?php

include("dbconnect.php");

$user_id = $_COOKIE['user_id'];
$getPost = $_POST['books'];
$books = explode(" ",$getPost);

$num = count($books);

$type = $books[$num-1];    //$type:申請類型 (1:申請租借 2:申請歸還)

$num = $num - 1;

$date = date("Ymd",time());

if($type == 1){              //申請租借

	for($i=0; $i<$num; $i++){
	
		 $query = "INSERT INTO record (u_id, b_id, apply_rent_date) VALUES('$user_id', $books[$i], '$date')";
		 
		 mysqli_query($dbc, $query) or die('Error query database');

		$query = "UPDATE books SET status=2 WHERE book_id=$books[$i]";
		mysqli_query($dbc, $query) or die('Error query database');

	} //for


 	echo "申請成功~~~<br/>畫面將於1秒後跳轉";

 	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?mode=1';
 	echo "<script language=\"javascript\">setTimeout(\"window.location.href='".$home_url."'\",1000)</script>";

}    //if


if($type == 2){            //申請歸還

	for($i=0; $i<$num; $i++){
	
		$query = "UPDATE record SET apply_back_date='$date' WHERE b_id='$books[$i]'";
		mysqli_query($dbc, $query) or die('Error query database');

		$query = "UPDATE books SET status=3 WHERE book_id=$books[$i]";
		mysqli_query($dbc, $query) or die('Error query database');

	} //for


	echo "申請成功~~~<br/>畫面將於1秒後跳轉";

	$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?mode=1';
 	echo "<script language=\"javascript\">setTimeout(\"window.location.href='".$home_url."'\",1000)</script>";

}    //if





?>