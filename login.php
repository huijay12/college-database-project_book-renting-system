<?php

	include("dbconnect.php");

	$error_msg = "";
	
	if(!isset($_COOKIE['user_name'])){
		if(isset($_POST['submit'])){

			//Grab the user-entered log-in data
			$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
			$phonenum = mysqli_real_escape_string($dbc, trim($_POST['phonenum']));

			if(!empty($username) && !empty($phonenum)){

				//Look up the username and phone number in the database
				$query = "SELECT * FROM users WHERE name = '$username' AND phone_num = '$phonenum'";
				// mysqli_query($dbc, "SET NAMES UTF8");
				$result = mysqli_query($dbc, $query);

				mysqli_close($dbc);

				// echo $username . "   " . $phonenum . "<br/>";

				//echo mysqli_num_rows($result);

				 if(mysqli_num_rows($result) == 1){

					$row = mysqli_fetch_array($result);
					setcookie('user_id', $row['stu_id']);
					setcookie('user_name', $row['name']);

					$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?mode=1';
					header('Location: ' . $home_url);

				}
				else{
					// 姓名 或 手機錯誤, 顯示錯誤訊息
					$error_msg = "輸入錯誤!!";
				}


			}
			else{
				//少輸入東西, 顯示錯誤訊息
				$error_msg = "少輸入東西!!";
			}
		}
	}
?>


<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>登入</title>
		<link href="rentBook.css" type="text/css" rel="stylesheet"></link>
	</head>
	<body>

		<h3>登入</h3>
		<?php
			if(empty($_COOKIE['user_name'])){
				echo $error_msg;
		?>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"><br />
				<fieldset>
					<legend>登入</legend>
					<label for="username">姓名: </label>
					<input type="text" id="username" name="username" 
							value="<?php if(!empty($username)) echo $username; ?>"><br />
					<label for="phonenum">手機號碼: </label>
					<input type="text" id="phonenum" name="phonenum">
				</fieldset>
				<input type="submit" value="登入" name="submit">
			</form>
		<?php
			}
			else{
				echo "登入成功!!  " . $_COOKIE['user_name'] . $row['stu_id'] . "!!";

			}

		?>	


	</body>
</html>