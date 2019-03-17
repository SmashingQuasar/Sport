<?php

//Elie Bismuth


require  __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$repVues = __DIR__ . DIRECTORY_SEPARATOR .'Views/';

use App\OpenWeather;

$etape= 0;
if(!empty($_GET)){

    $action = $_GET['action'];

    if(!empty($action))
    {

        switch($action)
        {
     
            case 'meteo' :
                $etape = 10;
                //Instancation de OpenWeather avec l'ApiKey donné par l'Api lors de la création d'un compte
                $meteo = new OpenWeather("570906fdd9e00f22e3a55df82c32a992");
                $error = null;
            
                try{
                    $forecast = $meteo->getForecast("Paris,fr");
                    $today = $meteo->getToday("Paris,fr");
                } catch(Exception $e){
                    $error = $e->getMessage();
                }
                break;

        }

    }
}

include($repVues."globals/v_entete.php") ;
include($repVues."globals/v_accueil.php") ;
include($repVues."globals/v_pied.php");