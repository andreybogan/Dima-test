<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Поиск по YouTube.</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <form action="#" id="formSearch">
      <input type="text" id="searchValue" placeholder="Поиск видео на YouTube">
      <button id="searchSubmit" type="submit">Найти</button>
    </form>

    <div id="searchContainer"></div>
    <button id="searchSave" class="hide">Сохранить результат</button>
  </div>


  <script src="./jquery-3.3.1.min.js"></script>
  <script src="./SearchYoutube.js"></script>
  <script>
    "use strict";

    // Инициализируем объект поиска по Youtube.
    new SearchYoutube();
  </script>
</body>
</html>