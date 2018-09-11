<?php
$arr = $_POST['arr'];

// Создаем текущую метку времени.
$time = time();

// Создаем файл с именем текущей метки времени.
$fp = fopen("c:\OSPanel\domains\Dima-test\\$time.csv", "w");

//$arr = array (
////  array('aaa', 'bbb', 'ccc', 'dddd'),
////  array('123', '456', '789'),
////  array('"aaa"', '"bbb"')
////);

foreach ($arr as $d) {
  fputcsv($fp, $d);
}

fclose($fp);
