"use strict";

$(document).ready(function () {
  $('#get').on('click', function () {
    $.ajax({
      type: 'GET',
      url: '/get_youtube.php',
      dataType: 'html',
      //В случаем успеха.
      success: function (data) {
        let youtube = $(data);
        console.log($(document).append(data));
      },
      //В случае ошибки выводим в консоль собщение.
      error: function (error) {
        console.log('Ошибка при получении содержимого корзины', error);
      }
    });
  });

  $('#save').on('click', function () {
    $.ajax({
      type: 'POST',
      url: '/set_youtube.php',
      // dataType: 'html',
      data: {'arr':[["http", 'title', 'img'], ['1', '2', '3']]}

    });
  });
});