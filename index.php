<?PHP header("Content-Type: text/html; charset=utf-8");
if (isset($_POST['price']) && isset($_POST['client'])) {
require 'char_count.php';
}
else {
require 'form.html';
}
?>
<h2> Общая статистика </h2> 
<table> 
	<tr> 
		<td>Номер</td> 
		<td>Название </td> 
		<td> Размер </td> 
		<td> Дата </td>
		<td> Доход </td> 		
	</tr>
<?php
// require 'db_connect.php';
// $query = mysqli_query($dbc, 'SELECT * FROM `day_stats`');
// while ($row === TRUE) {
// $row=mysqli_fetch_array($query);
// $profit = ($row['price'] * $row['size']) / 1000;
// echo $profit;
// echo '<tr><td>' . $row['id'] . '</td><td>' .$row['filename'] .'</td><td>' . $row['size'] .  '</td><td>' . $row['dates'] .  '</td><td>' . $profit . '</tr> </table>';
// }







?>

