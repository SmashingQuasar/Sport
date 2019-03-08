<?php

//Elie Bismuth


require  __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$repVues = __DIR__ . DIRECTORY_SEPARATOR .'Views/';

use App\Club;
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

        if($action === 'listerClubAdherents')
        {
            $clubs = Club::getClubs();
            $etape = 3;
        }

    }
}

if(!empty($_POST))
{
    //On vient du formulaire demandant se choisir un club pour lister ses adhérents
    if(!empty($_POST['selectedClub']))
    {    
        $clubs = Club::getClubs();
        $club=  explode("-", $_POST['selectedClub']);
        $adherentsClub = Club::getAdherents( (int) $club[0]);
        $etape= 4;
    }

}






include($repVues."v_entete.php") ;
include($repVues."v_accueil.php") ;
include($repVues."v_pied.php");