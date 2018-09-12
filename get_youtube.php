<?php
require 'vendor/autoload.php';

class YouTubeVideo {
    private $apiKey = 'AIzaSyAM_JIOHj1IvQq9AJK92fHiJPZFrmltW-k';
    private $youtube;

    public function __construct() {
        $client = new Google_Client();
        $client->setDeveloperKey($this->apiKey);
        $this->youtube = new Google_Service_YouTube($client);
    }

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

    public function getDataVideo(array $videos){
        $dataset = [];
        array_walk($videos, function ($value) use (&$dataset){
            $dataset[] = array(
                'id' => $value->toSimpleObject()->id['videoId'],
                'title' => $value->toSimpleObject()->snippet['title'],
                'preview' => $value->toSimpleObject()->snippet['thumbnails']['medium']['url']
            );
        });
        return $dataset;
    }
}

$videos = new YouTubeVideo();
$dataBySearch = $videos->search('63 покупки', 10, 'ru');
$videos_date = $videos->getDataVideo($dataBySearch->getItems());
$jsonCode = json_encode($videos_date);
echo $jsonCode;





