<?php

	include("dbconnect.php");

	$error_msg = "";
	
	if(!isset($_COOKIE['manager_name'])){
		if(isset($_POST['submit'])){

			//Grab the user-entered log-in data
			$managername = mysqli_real_escape_string($dbc, trim($_POST['managername']));
			$password = mysqli_real_escape_string($dbc, trim($_POST['password']));

			if(!empty($managername) && !empty($password)){

				//Look up the username and phone number in the database
				$query = "SELECT * FROM manager WHERE name = '$managername' AND password = '$password'";
				mysqli_query($dbc, "SET NAMES UTF8");
				$data = mysqli_query($dbc, $query);

				mysqli_close($dbc);

				// echo $username . "   " . $phonenum . "<br/>";

				echo mysqli_num_rows($data);

				 if(mysqli_num_rows($data) == 1){

					$row = mysqli_fetch_array($data);
					setcookie('manager_id', $row['id']);
					setcookie('manager_name', $row['name']);

					echo $row['id'] . $row['password'] . $row['name'] ;

					$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/manager.php?mode=3';
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
			if(empty($_COOKIE['manager_name'])){
				echo $error_msg;
		?>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"><br />
				<fieldset>
					<legend>登入</legend>
					<label for="username">帳號: </label>
					<input type="text" id="managername" name="managername" 
							value="<?php if(!empty($managername)) echo $managername; ?>"><br />
					<label for="phonenum">密碼: </label>
					<input type="password" id="password" name="password">
				</fieldset>
				<input type="submit" value="登入" name="submit">
			</form>
		<?php
			}
			else{
				echo "登入成功!!  " . $_COOKIE['manager_name'] . $_COOKIE['manager_id'] . $_COOKIE['manager_pw'] . "!!";

				header('Location: manager.php' );

			}

		?>	


	</body>
</html>