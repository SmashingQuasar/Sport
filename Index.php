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

            case 'listerClubAdherents' :
                $clubs = Club::getClubs();
                $etape = 3;
                break;

            case 'ajouterAdherent' :
                $clubs = Club::getClubs();
                $etape = 5;
                break;

            case 'statGlobal':
                $etape = 6 ; 
                $nbHommes = Adherent::getNbHommes();
                $nbFemmes = Adherent::getNbFemmes();
                $nbTotal = $nbHommes[0] + $nbFemmes[0];
                break;

            case 'statClubs':
                $etape = 7 ; 
                $clubs = Club::getClubs();
                break;
            
            case 'statAges':
                $etape = 9 ; 
                break;
        }

    }
}

if(!empty($_POST))
{
    //On vient du formulaire demandant de choisir un club pour lister ses adhérents
    if($_GET['action'] === 'listerClub'){
            
        $clubs = Club::getClubs();
        $idClub = $_POST['selectedClub'];
        $adherentsClub = Club::getAdherents( (int) $idClub);
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
            $idAdherent= Cnx::getLastInsertId();
            $ok = AdherentsEstInscrit::AjouterInscription($idAdherent, $idClub[0], date('Y-m-d'), $licence);
            $sucess = true ;
        }
    }

    //On vient du formulaire demandant de choisir un club pour voir ses stats
    if($_GET['action'] === 'statClub'){    

        $clubs = Club::getClubs();
        
        //explode afin de récupérer l'id du club 
        $club=  explode("-", $_POST['selectedClub']);
        
        $adherents = Club::getAdherents( (int) $club[0]);

        $nbHommes = 0;
        $nbFemmes= 0 ;
        //On récupére le nombre H-F d'un club
        foreach($adherents as $adherent)
        {
            if($adherent['genre'] === 'M')
            {
                $nbHommes = $nbHommes + 1;
            }
            else
            {
                $nbFemmes = $nbFemmes + 1;
            }
        
        }
            //On construit le tableau avec les datas
        $data[]=[
            'nom_club' => $club[1],
            'hommes' => $nbHommes,
            'femmes' => $nbFemmes
        ];
  
        $etape= 8;
    }

}

include($repVues."globals/v_entete.php") ;
include($repVues."globals/v_accueil.php") ;
include($repVues."globals/v_pied.php");