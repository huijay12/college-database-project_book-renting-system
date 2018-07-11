<?php
	include("dbconnect.php");

	define('uploadpath', 'images/');

	if(isset($_GET['mode']))
		$mode = $_GET['mode'];
	else
		$mode = 3;

	$date = date("Ymd",time());
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>管理者模式</title>
		<link href="rentBook.css" type="text/css" rel="stylesheet"></link>
	</head>

	<body>

		<div class="container">

			<div class="header">
				<div class="member_Area">

				<?php
					echo "哈囉! " . $_COOKIE['manager_name'] . "<br/>";
					echo "<form  action=\"logout.php\"><input name=\"logout\" type=\"submit\" value=\"登出\"></form>";

				?>
				</div>
				<h1 class="title1">NTUECS 二手書租借系統</h1>
				<p>管理員大大跪安Orz</p>

			</div>

			<div class="SelectBar">
				<div class="ModeBtn"><input type="button" value="申請借書清單" onclick="self.location.href='<?=$_SERVER['PHP_SELF']?>?mode=1'" /></div>
				<div class="ModeBtn"><input type="button" value="申請還書清單" onclick="self.location.href='<?=$_SERVER['PHP_SELF']?>?mode=2'" /></div>
				<div class="ModeBtn"><input type="button" value="新書上架" onclick="self.location.href='<?=$_SERVER['PHP_SELF']?>?mode=3'" /></div>
			</div>

			<div class="manageZone">

				<?php
					switch($mode){ 

						case 1:        //申請借書清單

							echo "<h3>申請借書清單</h3>";

							$query = "SELECT b.book_id, b.name, b.image, b.version, u.name, apply_rent_date 
							FROM books AS b, users AS u, record WHERE status='2' AND b.book_id=b_id AND u_id=u.stu_id";

							$result = mysqli_query($dbc, $query) or die('Error query database');

							mysqli_close($dbc);

							$num = mysqli_num_rows($result);

							if($num == 0)
								{echo "目前無申請記錄"; break;}


							echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '?mode=5" onsubmit="return Check();" >';
							echo '<table>';      

							while($row = mysqli_fetch_array($result)){
						
								echo '<tr>';
								echo '<td>' . $row['book_id'] . '</td>'.
									'<td><img src="'. uploadpath . $row['image'] .'"></td>'.
									'<td>' . $row['1'] .'</td>'.               /*超詭異索引???????????????????????????????*/
							 		'<td>版本:' . $row['version'] . "</td>".
									'<td>狀態: 租借申請中</td>'.
									'<td>申請人: ' . $row['name'] . '</td>'.
									'<td>申請時間: ' . $row['apply_rent_date'] . '</td>';	
								echo'<td><input type="checkbox" name="books[]" value="' . $row['book_id'] . '"></td>';
								echo '</tr>';

							}

							echo '<tr>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td><input type="submit" name="submit" value="核可申請"></td>'.
								'</tr>';


			 				echo '</table>';

			 				echo '</form>';

						break;

						case 2:       //申請還書清單

							echo "<h3>申請還書清單</h3>";

							$query = "SELECT b.book_id, b.name, b.image, b.version, u.name, apply_back_date 
							FROM books AS b, users AS u, record WHERE status='3' AND b.book_id=b_id AND u_id=u.stu_id";

							$result = mysqli_query($dbc, $query) or die('Error query database');

							mysqli_close($dbc);

							$num = mysqli_num_rows($result);

							if($num == 0)
								{echo "目前無申請記錄"; break;}


							echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '?mode=6" onsubmit="return Check();" >';
							echo '<table>';      

							while($row = mysqli_fetch_array($result)){
						
								echo '<tr>';
								echo '<td>' . $row['book_id'] . '</td>'.
									'<td><img src="'. uploadpath . $row['image'] .'"></td>'.
									'<td>' . $row['1'] .'</td>'.               /*超詭異索引???????????????????????????????*/
							 		'<td>版本:' . $row['version'] . "</td>".
									'<td>狀態: 歸還申請中</td>'.
									'<td>申請人: ' . $row['name'] . '</td>'.
									'<td>申請時間: ' . $row['apply_back_date'] . '</td>';	
								echo'<td><input type="checkbox" name="books[]" value="' . $row['book_id'] . '"></td>';
								echo '</tr>';

							}

							echo '<tr>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td><input type="submit" name="submit" value="核可申請"></td>'.
								'</tr>';


			 				echo '</table>';

			 				echo '</form>';

						


						break;

						case 3:       //新書上架
				?>

						<h3>新書上架</h3>
						<form action="onShelf.php" method="post" enctype="multipart/form-data">
						書名: <input type="text" name="bookname"><br/>
						版本: <select name="version">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select><br/>
						科目: <select name="subject">
										<option value="演算法">演算法</option>
										<option value="離散數學">離散數學</option>
										<option value="機率">機率</option>
										<option value="資料結構">資料結構</option>
										<option value="微積分">微積分</option>
										<option value="C++">C++</option>
										<option value="JAVA">JAVA</option>
										<option value="其他">其他</option>
									</select><br/>
						上傳圖片: <input type="file" name="bookImg"/><br/>
						<input type="submit" name="submit" value="上架"/>
						</form>
				<?php	
						break;

						case 4:





						
						break;




						case 5: 

							$books = $_REQUEST["books"];

							$num = count($books);

							for($i=0; $i<$num; $i++){

								$query = "UPDATE record SET lend_time='$date' WHERE b_id=$books[$i]";
								mysqli_query($dbc, $query) or die('Error query database');

								$query = "UPDATE books SET status=4 WHERE book_id=$books[$i]";
								mysqli_query($dbc, $query) or die('Error query database');

							}

							echo "核可成功!<br/>畫面將1秒後跳轉";
							$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/manager.php?mode=1';
 							echo "<script language=\"javascript\">setTimeout(\"window.location.href='".$home_url."'\",1000)</script>";

						break;



						case 6:

							$books = $_REQUEST["books"];

							$num = count($books);

							for($i=0; $i<$num; $i++){

								$query = "UPDATE record SET back_time='$date' WHERE b_id=$books[$i]";
								mysqli_query($dbc, $query) or die('Error query database');

								$query = "UPDATE books SET status=1 WHERE book_id=$books[$i]";
								mysqli_query($dbc, $query) or die('Error query database');

							}

							echo "核可成功!<br/>畫面將1秒後跳轉";
							$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/manager.php?mode=1';
 							echo "<script language=\"javascript\">setTimeout(\"window.location.href='".$home_url."'\",1000)</script>";

						break;





					} //switch ?>

			</div>

		</div>

	</body>
</html>