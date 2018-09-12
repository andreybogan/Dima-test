<?php
//include("class.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Index</title>
</head>
<body>
  <button id="get">Получить</button>
  <div id="container"></div>
  <button id="save">Сохранить</button>

  <?php

  $video_id = '0KSOMA3QBU0';
  $api_key = 'AIzaSyB7oqNYxEGnskHEpKHSCbIH_-VI4_sJkzg';

  $json_result =
    file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet&id=$video_id&key=$api_key");
  $obj = json_decode($json_result);

  echo $title = $obj->items[0]->snippet->title; //название видео
  echo $date = $obj->items[0]->snippet->publishedAt; //дата публикации


  //  $video = new YouTubeVideo();
  //  $dataById = $video->videosByIds('FBnAZnfNB6U');
  //  echo $dataById;
  ?>


  <script src="./jquery-3.3.1.min.js"></script>
  <script src="/serch_10_elem.js"></script>
</body>
</html>