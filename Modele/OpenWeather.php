<?php

namespace App;

use DateTime;
use Exception;

class OpenWeather {


    private $apiKey;
    
    public function __construct(string $apikey)
    {
        $this->apiKey = $apikey;
    }


    public function getToday(string $city) : ?array
    {
        try{
            $data = $this->callAPI("weather?q={$city}");
        }
        catch(Exception $e){

            die($e->getMessage());
        }
    
        $result  = [
            'temp' => $data['main']['temp'],
            'description' => $data['weather'][0]['description'],
            'date' => new DateTime()
        ];

        return $result;
    }


    public function getForecast(string $city) : ?array 
    {

        try{
            $data = $this->callAPI("forecast/daily?q={$city}");
        }
        catch(Exception $e){

            die($e->getMessage());
        }
        
        foreach($data['list'] as $day){
            $result [] = [
                'temp' => $day['temp']['day'],
                'description' => $day['weather'][0]['description'],
                'date' => new DateTime('@' . $day['dt'])
                //@ pour construire une date a partir d'un timestamp
            ];
        }

        return $result;
    }

    private function callAPI(string $endpoint) : ?array
    {

        $curl = curl_init("https://api.openweathermap.org/data/2.5/{$endpoint}&APPID={$this->apiKey}&units=metric&lang=fr");
        curl_setopt_array( $curl ,[
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CAINFO => dirname(__DIR__) . DIRECTORY_SEPARATOR . "cert.cer"
        ]);
        $data = curl_exec($curl);
     
        //Si pas de réponse de l'API
        if ($data === false)
        {
            $error = curl_error($curl);
            curl_close($curl);
            throw new Exception($error);
        }

        //Si erreur body de la reponse(bad url)
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200)
        {
            throw new Exception($data);
        }

        $data = json_decode($data , true);
        var_dump($data);
        curl_close($curl);

        return $data;

    }


    }