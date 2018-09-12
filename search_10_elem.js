"use strict";

/**
 * Функция выполнится как только полностью загрузится DOM.
 */
$(document).ready(function() {

  //Массив с данными полученный у API YouTube.
  let $arr = [];

  /**
   * Функция обрабатывает событие клика по кнопке "Получить".
   */
  $('#get').on('click', function() {
    //Делаем AJAX-запрос.
    $.ajax({
      type: 'POST',
      url: 'get_youtube.php',
      dataType: 'json',

      //В случаем успеха:
      success: function(data) {
        //Очищаем контейнер.
        $('#content').empty();
        //Очищаем массив.
        $arr = [];
        //Показываем кнопку "Сохранить результат".
        $('#save').css('display', 'inline');
        //Добавляем описание.
        $('#description').html('Получены первые 10 результатов по поисковому запросу "63 покупки..."');
        //Добавляем шапку таблицы.
        $('#content').append('<tr><td class="title">Preview</td><td class="title">Title</td></tr>');
        //Перебираем массив с данными полученный у API YouTube.
        for (let i = 0; i < data.length; i++) {
          //Каждому id добавляем часть адреса для получения полноценных ссылок на видео.
          data[i].id = 'https://www.youtube.com/watch?v=' + data[i].id;
          //Копируем массив в локальную переменную, для последующей отправки на сервер.
          $arr.push(data[i]);
          //Заполняем таблицу полученными данными.
          $('#content').append(`<tr><td><img src = "${data[i].preview}"></td><td>${data[i].title}</td></tr>`);
        }
      },

      //В случае ошибки выводим сообщение в консоль:
      error: function(error) {
        console.log('Ошибка при получении содержимого', error);
      }
    });
  });

  /**
   * Функция обрабатывает событие клика по кнопке "Сохранить результат".
   */
  $('#save').on('click', function() {
    //Делаем AJAX-запрос для отправки данных на сервер.
    $.ajax({
      type: 'POST',
      url: 'set_youtube.php',
      data: {'arr' : $arr}
    });
  });

});