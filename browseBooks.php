<?php 

	if(isset($_GET['type']))
		$type = $_GET['type'];
	else
		$type = 0;
?>

<select onchange="location.href=this.options[this.selectedIndex].value;" style="width:150px">
	<option value="<?=$_SERVER['PHP_SELF']?>?mode=1&type=0" <?php if($type==0) echo 'selected="selected"'; ?>>總覽</option>
	<option value="<?=$_SERVER['PHP_SELF']?>?mode=1&type=1" <?php if($type==1) echo 'selected="selected"'; ?>>可租借</option>
	<option value="<?=$_SERVER['PHP_SELF']?>?mode=1&type=2" <?php if($type==2) echo 'selected="selected"'; ?>>已借出</option>
	<option value="<?=$_SERVER['PHP_SELF']?>?mode=1&type=3" <?php if($type==3) echo 'selected="selected"'; ?>>租借申請中</option>
	<option value="<?=$_SERVER['PHP_SELF']?>?mode=1&type=4" <?php if($type==4) echo 'selected="selected"'; ?>>還書申請中</option>
</select>



<?php

	switch($type){

		case 0:

				echo '<table>';
				
					$query = "SELECT * FROM books";  //所有書

					$result = mysqli_query($dbc, $query) or die('Error query database');

					mysqli_close($dbc);

					while($row = mysqli_fetch_array($result))
					{
						echo '<tr>';
						echo '<td>' . $row['book_id'] . 
							'</td><td>'. '<img src="'. uploadpath . $row['image'] .'">' .
							'</td><td>' . $row['name'] .'</td>'.
							 '<td>版本:' . $row['version']. '</td>'.
							 '<td>科目: ' . $row['subject'] . '</td>';
							 
							 switch($row['status'])
									{
										case 1:
											echo "<td>狀態: 可租借</td>"; break;
										case 2:
											echo "<td>狀態: 租借申請中</td>"; break;
										case 3:
											echo "<td>狀態: 歸還申請中</td>"; break;
										case 4:
											echo "<td>狀態: 已借出</td>"; break;
									}
						echo '</tr>';
					}

			 	echo '</table>';






			break;

		case 1:

			$query = "SELECT * FROM books WHERE status='1'";  //可租借的書
			$result = mysqli_query($dbc, $query) or die('Error query database');
			mysqli_close($dbc);

			

				echo '<table>';
					while($row = mysqli_fetch_array($result)){

						echo '<tr>';
						echo '<td>' . $row['book_id'] . '</td>'.
							'<td>'. '<img src="'. uploadpath . $row['image'] .'">' .'</td>' .
							'<td>' . $row['name'] .'</td>'.
							'<td>版本:' . 	$row['version'] . "</td>".		
							"<td>狀態: 可租借</td>";
						echo '</tr>';


					}

				echo '</table>';

			break;

		case 2:

			$query = "SELECT b.book_id, b.name, b.image, b.version, u.name, lend_time 
			FROM books AS b, users AS u, record WHERE status='4' AND b.book_id=b_id AND u_id=u.stu_id";  //已借出的書
	

					$result = mysqli_query($dbc, $query) or die('Error query database');

					mysqli_close($dbc);

		 	echo '<table>';           

					while($row = mysqli_fetch_array($result))
					{
						echo '<tr>';
						echo '<td>' . $row['book_id'] . '</td>'.
							'<td><img src="'. uploadpath . $row['image'] .'"></td>'.
							'<td>' . $row['1'] .'</td>'.               /*超詭異索引???????????????????????????????*/
							 '<td>版本:' . $row['version'] . "</td>".
							"<td>狀態: 已借出</td>".
							'<td>租借人: ' . $row['name'] . '</td>'.
							'<td>租借時間: ' . $row['lend_time'] . '</td>';	
						echo '</tr>';
					}

			 	echo '</table>';

			 	break;

		case 3:

			$query = "SELECT b.book_id, b.name, b.image, b.version, u.name, apply_rent_date 
			FROM books AS b, users AS u, record WHERE status='2' AND b.book_id=b_id AND u_id=u.stu_id";  //租借申請中

			$result = mysqli_query($dbc, $query) or die('Error query database');

			mysqli_close($dbc);

			echo '<table>';           

					while($row = mysqli_fetch_array($result))
					{
						echo '<tr>';
						echo '<td>' . $row['book_id'] . '</td>'.
							'<td><img src="'. uploadpath . $row['image'] .'"></td>'.
							'<td>' . $row['1'] .'</td>'.               /*超詭異索引???????????????????????????????*/
							 '<td>版本:' . $row['version'] . "</td>".
							"<td>狀態: 租借申請中</td>".
							'<td>申請人: ' . $row['name'] . '</td>'.
							'<td>申請時間: ' . $row['apply_rent_date'] . '</td>';	
						echo '</tr>';
					}

			 	echo '</table>';


				break;

		case 4:

			$query = "SELECT b.book_id, b.name, b.image, b.version, u.name, apply_back_date 
			FROM books AS b, users AS u, record WHERE status='3' AND b.book_id=b_id AND u_id=u.stu_id";  //租借申請中

			$result = mysqli_query($dbc, $query) or die('Error query database');

			mysqli_close($dbc);

			echo '<table>';           

					while($row = mysqli_fetch_array($result))
					{
						echo '<tr>';
						echo '<td>' . $row['book_id'] . '</td>'.
							'<td><img src="'. uploadpath . $row['image'] .'"></td>'.
							'<td>' . $row['1'] .'</td>'.               /*超詭異索引???????????????????????????????*/
							 '<td>版本:' . $row['version'] . "</td>".
							"<td>狀態: 還書申請中</td>".
							'<td>申請人: ' . $row['name'] . '</td>'.
							'<td>申請時間: ' . $row['apply_back_date'] . '</td>';	
						echo '</tr>';
					}

			 	echo '</table>';

				break;

	}






?>