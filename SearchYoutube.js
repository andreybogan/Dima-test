"use strict";

/**
 * Класс описывающий работу поиска видео с YouTube и сохранения результатов поиска.
 */
class SearchYoutube {
  /**
   * Конструктор иницифлизирует свойства класса, методы и обработчики событий.
   */
  constructor() {
    // Элемент контейнера формы поиска.
    this.$elemFormSearch = $('#formSearch');
    // Элемент поля поиска.
    this.$elemSearchValue = $('#searchValue');
    // Элемент контейнера для вывода результатов.
    this.$elemContainer = $('#searchContainer');
    // Селектор кнопки сохранить.
    this.selectorSave = '#searchSave';
    // Путь к файлу возвращающему список видео в json формате.
    this.pathAjaxVideos = './get_youtube.php';
    // Инициализируем переменную в которую поместим результаты поиска.
    this.dataResalt;

    // Инициализируем обработчик событий по кнопке найти видео.
    this.$elemFormSearch.on('submit', event => this.formSubmit(event));

    // Инициализируем обработчик событий по кнопке сохранить видео.
    $('.container').on('click', this.selectorSave, event => this.saveResult(event));
  }

  /**
   * Метод обрабатывает отправку формы поиска.
   * @param event
   */
  formSubmit(event) {
    // Отменяем действие по умолчанию для отправки формы.
    event.preventDefault();
    // Получаем через ajax данные от youtube api.
    this.getAjax(this.$elemSearchValue.val());
  }

  /**
   * Метод получаем через ajax данные от youtube api со списком видео.
   * @param {string} search - Значение по которому будет осуществляться поиск.
   */
  getAjax(search) {
    $.ajax({
      type: 'POST',
      url: this.pathAjaxVideos,
      dataType: 'json',
      data: {search: search},
      context: this,
      //В случаем успеха отрисовываем полученный результат.
      success: data => this.render(data),
      //В случае ошибки выводим в консоль собщение.
      error: function (error) {
        console.log('Ошибка при получении содержимого файла', error);
      }
    });
  }

  /**
   * Метод прорисовывает полученные данные на странице.
   * @param {arr} data - Массив из списка полученных видео.
   */
  render(data) {
    // Сохраняем данные в переменной.
    this.dataResalt = data;
    // Очищаем контейнер для размещения результатов.
    this.$elemContainer.html('');

    // Обходим в цикле все полученные элементы и добавляем их на страницу.
    for (let i = 0; i < data.length; i++) {
      // Создаем контейнер для элемента видео.
      let $elemContainerVideo = $('<div/>', {
        class: 'video-item'
      });

      // Создаем контейнер ссылку на видео для изображения.
      let $elemLinkImg = $('<a/>', {
        href: `https://www.youtube.com/watch?v=${data[i]['videoId']}`,
        target: "_blank"
      });

      // Создаем изображение товара.
      let elemImage = new Image();
      $(elemImage).attr({
        src: data[i]['thumbnailsUrl']
      });

      // ДОбавляем изображение в контейнер ссылку.
      $elemLinkImg.append($(elemImage));

      // Создаем ссылку с названием товара.
      let $elemLinkName = $('<a/>', {
        href: `https://www.youtube.com/watch?v=${data[i]['videoId']}`,
        text: data[i]['title'],
        target: "_blank"
      });

      // Собираем наш элемент товара.
      $elemContainerVideo.append($elemLinkImg);
      $elemContainerVideo.append($elemLinkName);

      // Добавляем собранный элемент в контейнер результатов на странице.
      this.$elemContainer.append($elemContainerVideo);
    }
    // Показываем кнопку Сохранить результат.
    $(this.selectorSave).removeClass('hide');
  }

  /**
   * Метод делает ajax запрос для добавления результатов поиска в файл с текущей меткой времени.
   */
  saveResult() {
    $.ajax({
      type: 'POST',
      url: './set_youtube.php',
      data: {'arr': this.dataResalt}
    });
  }
}