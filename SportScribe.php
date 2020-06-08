<?php
 
  require_once('config.php');

  class SportScribeClient {

    private $apiKey = null;

    function __construct($apiKey = '') {

      if($apiKey == '') {
        throw new Exception('Missing ApiKey');
      } else {
        $this->apiKey = $apiKey;
      }
    }

    private function checkKey() {
      if($this->apiKey == null)
        throw new Exception('Missing ApiKey');
    }

    private function get($endpoint) {

      global $ENDPOINT;

      if($endpoint[0] != '/') {
        throw new Exception('Endpoint must begin with "/"');
      }

      $url = $ENDPOINT . $endpoint;

      $this->checkKey();


      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'x-api-key: ' . $this->apiKey
      ));
      $result = curl_exec($curl);
      $responseCode = curl_getinfo($curl)['http_code'];
      if($responseCode == '200') {
        $j = json_decode($result);
        return $j;
      } else {
        return null;
      }
    }

    function getLeagues() : array {
      $j = $this->get('/leagues');
      if($j) return $j->leagues;
      else return null;
    }

    function getTeams($leagueId) : array {
      $j =$this->get('/teams/' . $leagueId);
      if($j) return $j->teams;
      else return null;
    }


    function getMatchPreviewByTeam($teamId) : mixed {
      return $this->get('/matchPreview/' . $teamId);
    }

    function getMatchPreviewByDate($date) :array {

      list($Y,$m,$d) = explode('-',$date);
      if(!checkdate($m,$d,$Y))
        throw new Exception('Invalid DateFormat. Must Be YYYY-MM-DD');
      else
        return $this->get('/matchPreview/date/' . $date);
    }


  }



?>
