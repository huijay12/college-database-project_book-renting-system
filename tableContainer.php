
	<div class="content">

		<?php

			if(isset($_COOKIE['user_name']))     //若登入, 顯示功能列
				{ ?>
		<div class="SelectBar">
			<div class="ModeBtn"><input type="button" value="書籍瀏覽" onclick="self.location.href='<?=$_SERVER['PHP_SELF']?>?mode=1'" /></div>
			<div class="ModeBtn"><input type="button" value="我要借書" onclick="self.location.href='<?=$_SERVER['PHP_SELF']?>?mode=2'" /></div>
			<div class="ModeBtn"><input type="button" value="我要還書" onclick="self.location.href='<?=$_SERVER['PHP_SELF']?>?mode=3'" /></div>
		</div>

		<?php }  ?>
		<div class="tableContainer">

			<?php

			if(isset($_GET['mode']))
				$mode = $_GET['mode'];
			else
				$mode = 1;


			switch($mode){

			case 1:       //書籍瀏覽

				require_once("browseBooks.php");
			 	break;


			case 2:        //申請借書

				echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '?mode=6" onsubmit="return Check();" >';
				echo '<table>';
				
					$query = "SELECT * FROM books WHERE status = '1'";

					$result = mysqli_query($dbc, $query) or die('Error query database');

					mysqli_close($dbc);

					$num = mysqli_num_rows($result);

					if($num == 0)
						{echo "目前無申請記錄"; break;}

					while($row = mysqli_fetch_array($result))
					{
						echo '<tr>';
						echo '<td>' . $row['book_id'] . '</td>'.
							'<td>'. '<img src="'. uploadpath . $row['image'] .'">' .'</td>'.
							'<td>' . $row['name'] .'</td>'.
							 '<td>版本:' . $row['version'] . "</td>".
							'<td>狀態: 可租借</td>'; 
						
										
						echo'<td><input type="checkbox" name="books[]" value="' . $row['book_id'] . '"></td>';

						echo '</tr>'; 

					}

						echo '<tr>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td><input type="submit" name="submit" value="借書!"></td>'.
							'</tr>';

			 	echo '</table>';

			 	echo '</form>';

				break;

			case 3:          //申請還書

				echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '?mode=7" onsubmit="return Check();" >';

				echo '<table>';
				
					$query = "SELECT * FROM books, record WHERE u_id='$userid' AND book_id=b_id AND status=4";

					$result = mysqli_query($dbc, $query) or die('Error query database');

					mysqli_close($dbc);

					$num = mysqli_num_rows($result);

					if($num == 0)
						{echo "目前無申請記錄"; break;}

					while($row = mysqli_fetch_array($result))
					{
						echo '<tr>';
						echo '<td>' . $row['book_id'] . 
							'</td><td>'. '<img src="'. uploadpath . $row['image'] .'">' .
							'</td><td>' . $row['name'] .
							 "</td><td>版本:" . $row['version'] . 
							 "</td><td>租借時間: " . $row['lend_time'] . "</td>";

						echo'<td><input type="checkbox" name="books[]" value="' . $row['book_id'] . '"></td>';

						echo '</tr>';
					}

						echo '<tr>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td></td>'.
								'<td><input type="submit" name="submit" value="還書!"></td>'.
							'</tr>';

			 	echo '</table>';

			 	echo '</form>';

				break;

				case 6:                                  /***************申請租借*****************/

					$books = $_REQUEST["books"];

					$num = count($books);

					echo "<h3>你已勾選以下書籍:</h3>" . "<br/>";
					echo "<table>";

					for($i=0; $i<$num; $i++)
					{

						$query = "SELECT * FROM books WHERE book_id='$books[$i]'";

						$result = mysqli_query($dbc, $query) or die('Error query database');

						$row = mysqli_fetch_array($result);

						echo "<tr>";

						echo '<td>' . $row['book_id'] . "</td>" . 
							 '<td>'. '<img src="'. uploadpath . $row['image'] .'">' .'</td>'.
							 '<td>' . $row['name'] . "</td>" .
							 "<td>科目: " . $row['subject'] . "</td>" .
							 '<td>版本: ' . $row['version'] . "</td>";

						echo "</tr>";
					}

					echo "<td></td><td></td><td></td><td></td>".
						"<td>確定租借?";

						$books['type'] = 1;        //books[]最後一個值代表申請類型, 1:借書 2:還書

						echo '<form action="application.php" method="post">';
						echo '<input type="hidden" name="books" value="' . implode(" ",$books) . '">';
						echo '<input type="submit" name="submit" value="確定">';
						echo '</form>';

					echo "</td>";

					echo "</table>";

				break;


				case 7:                                  /***************申請租借*****************/

					$books = $_REQUEST["books"];


					$num = count($books);

					echo "<h3>你已勾選以下書籍:</h3>" . "<br/>";
					echo "<table>";

					for($i=0; $i<$num; $i++)
					{

						$query = "SELECT * FROM books WHERE book_id='$books[$i]'";

						$result = mysqli_query($dbc, $query) or die('Error query database');

						$row = mysqli_fetch_array($result);

						echo "<tr>";

						echo '<td>' . $row['book_id'] . "</td>" . 
							 '<td>'. '<img src="'. uploadpath . $row['image'] .'">' .'</td>'.
							 '<td>' . $row['name'] . "</td>" .
							 "<td>科目: " . $row['subject'] . "</td>" .
							 '<td>版本: ' . $row['version'] . "</td>";

						echo "</tr>";
					}

					echo "<td></td><td></td><td></td><td></td>".
						"<td>確定歸還?";

						$books['type'] = 2;        //books[]最後一個值代表申請類型, 1:借書 2:還書

						echo '<form action="application.php" method="post">';
						echo '<input type="hidden" name="books" value="' . implode(" ",$books) . '">';
						echo '<input type="submit" name="submit" value="確定">';
						echo '</form>';

					echo "</td>";

					echo "</table>";

				break;





			} //switch


			?>

		</div>

	</div>