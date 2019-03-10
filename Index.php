<?php

//Elie Bismuth


require  __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$repVues = __DIR__ . DIRECTORY_SEPARATOR .'Views/';

use App\Club;
use App\Adherent;
use App\AdherentsEstInscrit;
use App\Tools;


$etape= 0;
if(!empty($_GET)){

    $action = $_GET['action'];

    if(!empty($action))
    {

        //Les variables $etapes sont utilisées dans la vue v_accueil afin de déterminer la vue a appeler
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
        if($action === 'ajouterAdherent')
        {
            $clubs = Club::getClubs();
            $etape = 5;
        }


    }
}

if(!empty($_POST))
{
    //On vient du formulaire demandant de choisir un club pour lister ses adhérents
    if($_GET['action'] === 'listerClub'){    
        $clubs = Club::getClubs();
        //explode afin de récupérer l'id du club 
        $club=  explode("-", $_POST['selectedClub']);
        $adherentsClub = Club::getAdherents( (int) $club[0]);
        $etape= 4;
    }

     //On vient du formulaire d'ajout d'un adherent
    if($_GET['action'] === 'ajouterAdherent'){
        
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $date= $_POST['date'];
        $genre=$_POST['genre'];
        $idClub=  explode("-", $_POST['club']);
        $licence= $_POST['licence'];
        
        //On ajoute l'adhérent dans la bdd
        $ok = Club::AjouterAdherent($prenom, $nom, $date, $genre);
        
        $sucess = false;
        //Si l'adhérent a bien été ajouté, on crée son inscription
        if($ok){
            $idAdherent= Tools::getLastInsertId();
            $ok = AdherentsEstInscrit::AjouterInscription($idAdherent, $idClub[0], date('Y-m-d'), $licence);
            $sucess = true ;
        }
    }

}


include($repVues."v_entete.php") ;
include($repVues."v_accueil.php") ;
include($repVues."v_pied.php");