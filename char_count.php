<!DOCTYPE html>
<html>
	<head>
		<title> Подсчет символов в документах Word</title>
		<meta http-equiv="content-type" content="text/html"; charset="utf-8" />
		<link rel="stylesheet" href="style.css">
		</title>
	</head>
	
	<body>
		<h1>Подсчет символов в документах Word</h1>
<?php

//Создаем объект класса ZipArchive и инициализируем переменные.
		$zip = new ZipArchive;
		$totalchar=0;
		$i=0;
		$price = $_POST['price'];
		$client = $_POST['client'];
		$dir = '/home/localhost/www/mystats/files/';	//папка, где лежат исходные файлы	
		$files = array_diff(scandir($dir), array('.', '..'));  //сканируем папку, названия найденных файлов помещаем в массив
		
		
		
		echo '<table> <tr> <td> Номер</td> <td>Название статьи</td> <td>Размер</td> <td>Всего симв.</td> </tr>'; //Шапка таблицы.
		
		//Соединяемся с БД
		
		if (!isset($dbc)){
		require 'db_connect.php';
		}
		
		foreach ($files as $key=>$filename) {
		$i= $i+1;
		echo '<tr><td>' . $i . '</td><td>' . iconv('Windows-1251', 'UTF-8', $filename) . '</td>' ;
		
		//распаковываем файлы в папку test
		if ($zip->open($dir . $filename) === TRUE) {
			$zip->extractTo('test/' . $filename . '/');
			$zip->close();
			} 
		else {
			echo 'Не удалось распаковать файл' . $filename;
		}

		//достаем текст из распакованных файлов, удаляем пробелы и считаем количество символов
		$file=fopen('/home/localhost/www/mystats/test/' . $filename . '/word/document.xml', 'r');
		while (!feof($file)){
		$text = $text . fgetss($file);
		}
		fclose ($file);
		$text_without_spaces = str_replace(' ', '', $text);
		$text = FALSE; //очищаем переменную $text
		
		$numb_char_without_spaces = mb_strlen($text_without_spaces, "utf-8");
		echo '<td>' . $numb_char_without_spaces . '</td>';
		
		//Добавляем данные в БД.
		$query = mysqli_query($dbc, 'INSERT INTO `day_stats` (`filename`, `dates`, `price`, `size`, `client`) VALUES ("' . iconv('Windows-1251', 'UTF-8', $filename) . '", "' . date('Y.m.d.') . '", "' . $price . '", "' . $numb_char_without_spaces . '", "' . $client .'")');
		
		$totalchar += $numb_char_without_spaces;
		echo '<td>' . $totalchar . '</td></tr>';
		}
		
		
		echo '</table>';
		
		
		
		echo '<br> Итого:' . $totalchar;
		
		
		
		?>
		
			</body>
		</html>