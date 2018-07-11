<?php

$dbc = mysqli_connect('127.0.0.1', 'root', 'adminadmin', 'rentbook')   //(DB位址, root, root密碼, 資料庫)
		   or die('Error connecting to MySQL server.');	

	mysqli_query($dbc, "SET NAMES UTF8");


$type = $_POST['type'];		



switch($type){

	case 1:
		$query = "SELECT * FROM books WHERE status='1'" ;                    //可租借的書

		$result = mysqli_query($dbc, $query) or die('Error query database');

		mysqli_close($dbc);

		$books_num = mysqli_num_rows($result);
		$return_ack = array();


		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){

			$row_array['book_id'] = $row['book_id'];
			$row_array['name'] = $row['name'];
			$row_array['subject'] = $row['subject'];
			$row_array['version'] = $row['version'];
			$row_array['image'] = $row['image'];

			array_push($return_ack,$row_array);

		}

		$ack = array('totalNumber'=>$books_num, 'books'=>$return_ack);

	break;


	case 2:
		$query = "SELECT b.book_id , b.name as bname, b.image, b.version,u.name, subject, apply_rent_date 
			FROM books AS b, users AS u, record WHERE status='2' AND b.book_id=b_id AND u_id=u.stu_id";  //租借申請中

		$result = mysqli_query($dbc, $query) or die('Error query database');

		mysqli_close($dbc);

		$books_num = mysqli_num_rows($result);
		$return_ack = array();

		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){

			$row_array['book_id'] = $row['book_id'];
			$row_array['name'] = $row['bname'];
			$row_array['subject'] = $row['subject'];
			$row_array['version'] = $row['version'];
			$row_array['image'] = $row['image'];
			$row_array['username'] = $row['name'];
			$row_array['date'] = $row['apply_rent_date'];

			array_push($return_ack,$row_array);

		}

		$ack = array('totalNumber'=>$books_num, 'books'=>$return_ack);  

		/*
		for($i=0; $i<$books_num; $i++){
			$row = mysqli_fetch_array($result);
			 //echo print_r($row);
			echo $row['bname']; 
		}*/
		

	break;


	case 3:
		$query = "SELECT b.book_id , b.name as bname, b.image, b.version,u.name, subject, apply_rent_date 
			FROM books AS b, users AS u, record WHERE status='3' AND b.book_id=b_id AND u_id=u.stu_id";  //還書申請中

		$result = mysqli_query($dbc, $query) or die('Error query database');

		mysqli_close($dbc);

		$books_num = mysqli_num_rows($result);
		$return_ack = array();

		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){

			$row_array['book_id'] = $row['book_id'];
			$row_array['name'] = $row['bname'];
			$row_array['subject'] = $row['subject'];
			$row_array['version'] = $row['version'];
			$row_array['image'] = $row['image'];
			$row_array['username'] = $row['name'];
			$row_array['date'] = $row['apply_rent_date'];

			array_push($return_ack,$row_array);

		}

		$ack = array('totalNumber'=>$books_num, 'books'=>$return_ack);  

		break;


		case 4:
		$query = "SELECT b.book_id , b.name as bname, b.image, b.version,u.name, subject, lend_time 
			FROM books AS b, users AS u, record WHERE status='4' AND b.book_id=b_id AND u_id=u.stu_id";    //已借出

		$result = mysqli_query($dbc, $query) or die('Error query database');

		mysqli_close($dbc);

		$books_num = mysqli_num_rows($result);
		$return_ack = array();

		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){

			$row_array['book_id'] = $row['book_id'];
			$row_array['name'] = $row['bname'];
			$row_array['subject'] = $row['subject'];
			$row_array['version'] = $row['version'];
			$row_array['image'] = $row['image'];
			$row_array['username'] = $row['name'];
			$row_array['date'] = $row['lend_time'];

			array_push($return_ack,$row_array);

		}

		$ack = array('totalNumber'=>$books_num, 'books'=>$return_ack); 

		break;





}


	 echo json_encode($ack);
	
	

?>