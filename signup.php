<?php
	
	$dbc = mysqli_connect('127.0.0.1', 'root', 'adminadmin', 'rentbook')
		   or die('Error connecting to MySQL server.');	
?>



<html>
	<head>
	</head>
	<body>

		<?php

		$emptyForm = true;

		if(isset($_POST['submit']))
		{
			$name = $_POST['name'];
			$id = $_POST['id'];
			$phone_num = $_POST['phone_num'];

			if(empty($name) || empty($id) || empty($phone_num))
				echo "少輸入東西喔!";
			elseif (strlen($id) != 9) {
				echo "學號輸入錯誤!";
			}
			elseif (strlen($phone_num) != 10) {
				echo "手機號碼輸入錯誤!";
			}
			else
			{

				$query = "INSERT INTO users (name, stu_id, phone_num) values ('$name', '$id', '$phone_num')";
				mysqli_query($dbc, $query)or die('Error query database'); 
				mysqli_close($dbc);

				echo $name . '<br/>' . $id . '<br/>' . $phone_num . '<br/>';
				echo "註冊成功!!<br/>";
				setcookie('user_name', $name);
				setcookie('user_id', $id);
				$emptyForm = false;
				echo "<a href = \"index.php\">回首頁</a>";
			}
		}

		if($emptyForm){
		?>

		<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

			<label for="name">姓名: </label>
			<input type="text" id="name" name="name" /><br />
			<label for="id">學號: </label>
			<input type="text" id="id" name="id" /><br />
			<label for="phone_num">手機: </label>
			<input type="text" id="phone_num" name="phone_num" /><br />

			<input type="submit" name="submit" value="送出" /><br />

		</form>
		<?php } ?>


	</body>
</html>