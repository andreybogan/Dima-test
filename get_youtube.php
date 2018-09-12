<?php
//Включаем и выполняем автолоадер компосера.
require 'vendor/autoload.php';

/**
 * Class YouTubeVideo Для работы с расширением apiclient.
 */
class YouTubeVideo {
    private $apiKey = 'AIzaSyAM_JIOHj1IvQq9AJK92fHiJPZFrmltW-k';
    private $youtube;

    public function __construct() {
        $client = new Google_Client();
        $client->setDeveloperKey($this->apiKey);
        $this->youtube = new Google_Service_YouTube($client);
    }

    /**
     * Поиск видео по фразе.
     * @param $q {str} Текс запроса.
     * @param $maxResults {int} Максимальное количесто результатов.
     * @param $lang {str} Язык.
     * @return Google_Service_YouTube_SearchListResponse {Object} Объект с результатами.
     */
    public function search($q, $maxResults, $lang){
        $response = $this->youtube->search->listSearch('snippet',
            array(
                'q' => $q,
                'maxResults' => $maxResults,
                'relevanceLanguage' => $lang,
                'type' => 'video'
            ));
        return $response;
    }

    /**
     * Вынимает нужные данные.
     * @param $videos {array} Массив объектов с полученные вызовом метода getItems()
     * у Google_Service_YouTube_VideoListResponse.
     * @return $dataset {array} Конечный результат.
     */
    public function getDataVideo(array $videos){
        $dataset = [];
        array_walk($videos, function ($value) use (&$dataset){
            $dataset[] = array(
                'title' => $value->toSimpleObject()->snippet['title'],
                'id' => $value->toSimpleObject()->id['videoId'],
                'preview' => $value->toSimpleObject()->snippet['thumbnails']['medium']['url']
            );
        });
        return $dataset;
    }
}

//Создаем экземпляр класса.
$videos = new YouTubeVideo();
//Делаем выборку и сохраняем ее в переменную.
$dataBySearch = $videos->search('63 покупки', 10, 'ru');
//Фильтруем и сортируем данные.
$videos_date = $videos->getDataVideo($dataBySearch->getItems());
//Формируем JSON для передачи.
$jsonCode = json_encode($videos_date);
//Передаем.
echo $jsonCode;





