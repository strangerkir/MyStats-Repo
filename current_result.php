<?php
$query = 'SELECT * FROM `day_stats`';


$result = mysqli_query($dbc, $query);
$total_price=0;
$i=0;
while ($row=mysqli_fetch_array($result)){
$i++;
$profit = round(($row['price'] * $row['size']) / 1000, 2) ;
$total_price += $profit;
echo '<tr><td>' . $i . '</td><td>' .$row['filename'] .'</td><td>' . $row['size'] .  '</td><td>' . $row['dates'] .  '</td><td>' . $profit . '</tr>';
}
echo '</table><br> Всего статей на сумму' . $total_price . 'рублей';


?>