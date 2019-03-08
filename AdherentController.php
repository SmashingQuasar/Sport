<?php

//Elie Bismuth


require  __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$repVues = __DIR__ . DIRECTORY_SEPARATOR .'Views/';

use App\Adherent;

$etape= 0;
if(!empty($_GET)){

    $action = $_GET['action'];

    if(!empty($action))
    {
        
        if($action === 'listerAdherentsAJour')
        {
            $tabAdherents = Adherent::getAllAdherents_AJour();
            $etape = 1;
        }

        if($action === 'listerAdherentsNonAJour')
        {
            $tabAdherents = Adherent::getAdherentsNonAJour();
            $etape = 2;
        }

    }
}

include($repVues."v_entete.php") ;
include($repVues."v_accueil.php") ;
include($repVues."v_pied.php");