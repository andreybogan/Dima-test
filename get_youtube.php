<?php

$api_key = 'AIzaSyB7oqNYxEGnskHEpKHSCbIH_-VI4_sJkzg';
$q = urlencode("63 покупка");
$json_result =
  file_get_contents("https://www.googleapis.com/youtube/v3/search?part=snippet&q=$q&type=video&maxResults=3&key=$api_key");
$obj = json_decode($json_result);

//echo $title = $obj->items[0]->snippet->title; //название видео
//echo "<br>";
//echo $id = $obj->items[0]->id->videoId; //дата публикации
//echo "<br>";
//echo $url = $obj->items[0]->snippet->thumbnails->default->url; //дата публикации
//echo "<br>";
//echo "<br>";

// Выделяем из объекта элемент items.
$newObj = $obj->items;

// Обходим наш массив в цикле и формируем новый массив только из нужных нам элементов.
foreach ($newObj as $list) {
  echo "<pre>";
  var_dump($list);
  echo "-------------------------------------------------";
  echo "</pre>";
}
echo $title = $obj->items[1]->snippet->title; //название видео
echo "<br>";
echo $date = $obj->items[1]->snippet->publishedAt; //дата публикации
echo "<br>";
echo "<br>";

echo $title = $obj->items[2]->snippet->title; //название видео
echo "<br>";;
echo $date = $obj->items[2]->statistics->viewCount; //дата публикации
echo "<br>";
echo "<br>";

echo $title = $obj->items[3]->snippet->title; //название видео
echo "<br>";
echo $date = $obj->items[3]->snippet->publishedAt; //дата публикации

//$homepage = file_get_contents('https://www.youtube.com/results?search_query=63+%D0%BF%D0%BE%D0%BA%D1%83%D0%BF%D0%BA%D0%B8');
//echo $homepage;