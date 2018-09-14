<?php
// API ключ.
$api_key = 'AIzaSyB7oqNYxEGnskHEpKHSCbIH_-VI4_sJkzg';
// Поисковый запрос.
$q = urlencode($_POST['search']);
// Задаем группы свойств, которые должны быть возвращены для ресурса.
$part = urlencode("snippet");
// Максимальное количество элементов, которые должны быть возвращены.
$maxResults = 10;
// Задаем тип ресурса: video,channel,playlist.
$type = 'video';
// Инициируем пустой массив для полученных результатов.
$arrResult = [];

// Обращаемся к ресурсу google api с заданными параметрами и получаем содержимое в виде строки json.
$json_result =
  file_get_contents("https://www.googleapis.com/youtube/v3/search?part=$part&q=$q&type=$type&maxResults=$maxResults&key=$api_key");

// Декодируем строку json.
$obj = json_decode($json_result);

// Обходим полученный результат в цикле и формируем ассоциативный массив из нужных нам элементов.
foreach ($obj->items as $list) {
  $arrResult[] = [
    "title" => $list->snippet->title,
    "thumbnailsUrl" => $list->snippet->thumbnails->default->url,
    "videoId" => $list->id->videoId,
  ];
}

// Возвращаем json-представление данных.
$arrResult = json_encode($arrResult, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo $arrResult;