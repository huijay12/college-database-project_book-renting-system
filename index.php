<?php

	include("dbconnect.php");

	define('uploadpath', 'images/');

	if(isset($_COOKIE['user_name'])){
		$username = $_COOKIE['user_name'];
	 	$userid = $_COOKIE['user_id'];
	}

?>	

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>NTUECS借書系統</title>
	<link href="rentBook.css" type="text/css" rel="stylesheet"></link>

</head>

<body>

<div class="container">
	
	<div class="header">
		<div class="member_Area">

			<?php
				if(!isset($_COOKIE['user_name'])){
				
				echo "<form  action=\"login.php\"><input name=\"login\" type=\"submit\" value=\"登入\"></form><a href=\"signup.php\">新會員註冊</a>";
				}
				else{

				echo "哈囉! " . $username . "<br/>";
				echo "<form  action=\"logout.php\"><input name=\"logout\" type=\"submit\" value=\"登出\"></form>";

				}
			?>
		</div>
		<h1 class="title1">NTUECS 二手書租借系統</h1>
		<p>借了要還喔! >__^	</p>

		

	</div>


	<?php require_once('tableContainer.php'); ?>

	

	<div class="footer">
		 <?php

			 if(!isset($_COOKIE['user_name']))
		     echo "<a href=\"login_manager.php\">管理者登入</a>";
		 	 else
		 	 {}


		?>

	</div>
</div>
</body>
</html>