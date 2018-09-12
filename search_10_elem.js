"use strict";

$(document).ready(function() {

  $('#get').on('click', function() {
    $.ajax({
      type: 'POST',
      url: 'get_youtube.php',
      dataType: 'json',
      //В случаем успеха.
      success: function(data) {
        console.log(data);
      },
      //В случае ошибки выводим в консоль собщение.
      error: function (error) {
        console.log('Ошибка при получении содержимого', error);
      }
    });
  });

  $('#save').on('click', function() {
    $.ajax({
      type: 'POST',
      url: 'set_youtube.php',
      //data:
    });
  });

});