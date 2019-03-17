<?php
//Elie Bismuth

namespace App;
use Exception;

class ApiGeo{


    public static function getDepartements() 
    {
        try{
            $data = self::callAPI("/departements");
        }
        catch(Exception $e){

            die($e->getMessage());
        }

        return $data;

    }


    /**
     * Appel à l'API de Api Geo
     * $endpoint représente l'URL qui va etre amenée à être modifiée en fonction de la requéte
     *
     * @param  mixed $endpoint
     *
     * @return array
     */
    private static function callAPI(string $endpoint) : ?array
    {

        $curl = curl_init("https://geo.api.gouv.fr{$endpoint}");
        curl_setopt_array( $curl ,[
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
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
        curl_close($curl);
        return $data;

    }

}