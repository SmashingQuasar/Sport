<?php

//Elie Bismuth


require  __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$repVues = __DIR__ . DIRECTORY_SEPARATOR .'Views/';

use App\Adherent;

$etape= 0;
if(!empty($_GET)){

    $action = $_GET['action'];

    //Routage de l'application
    if(!empty($action))
    {
        //Les variables $etape sont utilisées dans la vue v_accueil afin de déterminer la vue a appeler
        switch($action)
        {
            case 'listerAdherentsAJour' :
                $tabAdherents = Adherent::getAllAdherents_AJour();
                $etape = 1;
                break; 

            case  'listerAdherentsNonAJour' :
                $tabAdherents = Adherent::getAdherentsNonAJour();
                $etape = 2;
                break;
        }
    }
}

include($repVues."globals/v_entete.php") ;
include($repVues."globals/v_accueil.php") ;
include($repVues."globals/v_pied.php");