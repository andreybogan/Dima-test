<?php
$arr = $_POST[''];

// Создаем текущую метку времени.
$time = time();

// Создаем файл с именем текущей метки времени.
$fp = fopen("c:\OSPanel\domains\Dima-test\\$time.csv", "w");

foreach ($arr as $d) {
  fputcsv($fp, $d);
}

fclose($fp);
