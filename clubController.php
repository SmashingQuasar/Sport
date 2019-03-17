<?php

//Elie Bismuth


require  __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$repVues = __DIR__ . DIRECTORY_SEPARATOR .'Views/';

use App\Club;
use App\AdherentsEstInscrit;
use App\Cnx;


$etape= 0;
if(!empty($_GET))
{

    $action = $_GET['action'];

    //Routage de l'application
    if(!empty($action))
    {
        //Les variables $etape sont utilisées dans la vue v_accueil afin de déterminer la vue a appeler
        switch($action)
        {

            case 'listerClubAdherents' :
                $clubs = Club::getClubs();
                $etape = 3;
                break;

            case 'ajouterAdherent' :
                $clubs = Club::getClubs();
                $etape = 5;
                break;
        }
    }
}

if(!empty($_POST))
{
    //On vient du formulaire demandant de choisir un club pour lister ses adhérents
    if($_GET['action'] === 'listerClub'){
           
        //On récupere de nouveau les clubs , car lorsque le formulaire est submit, la même vue est appelé, et il faut
        //réinjecter les data des clubs dans la liste déroulante
        $clubs = Club::getClubs();
        $idClub = $_POST['selectedClub'];
        $adherentsClub = Club::getAdherents( (int) $idClub);
        $etape= 4;
    }

     //On vient du formulaire d'ajout d'un adherent
    if($_GET['action'] === 'ajouterAdherent'){
        
        $prenom = htmlentities($_POST['prenom']);
        $nom = htmlentities($_POST['nom']);
        $date= htmlentities($_POST['date']);
        $genre=htmlentities($_POST['genre']);
        $idClub=  explode("-", $_POST['club']);
        $licence= htmlentities($_POST['licence']);
        
        //On ajoute l'adhérent dans la bdd
        $ok = Club::AjouterAdherent($prenom, $nom, $date, $genre);
        
        $sucess = false;
        //Si l'adhérent a bien été ajouté, on crée son inscription
        if($ok){
            $idAdherent= Cnx::getLastInsertId();
            $ok = AdherentsEstInscrit::AjouterInscription($idAdherent, $idClub[0], date('Y-m-d'), $licence);
            $sucess = true ;
        }
    }


}

include($repVues."globals/v_entete.php") ;
include($repVues."globals/v_accueil.php") ;
include($repVues."globals/v_pied.php");