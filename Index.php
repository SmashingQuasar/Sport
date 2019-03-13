<?php

//Elie Bismuth


require  __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$repVues = __DIR__ . DIRECTORY_SEPARATOR .'Views/';

use App\Club;
use App\Adherent;
use App\AdherentsEstInscrit;
use App\Cnx;

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
                $adherents = Adherent::getAllAdherents();
                $adherents = Adherent::getGenres($adherents);
                $nbTotal= $adherents['hommes'] + $adherents['femmes'];
                break;

            case 'statClubs':
                $etape = 7 ; 
                $clubs = Club::getClubs();
                break;
            
            case 'statAges':
                $etape = 9 ;
                $adherents = Adherent::getAllAdherents();
                foreach($adherents as $adherent){
                    $ages[] = Adherent::getAge($adherent['date_naissance']);
                }

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
        $adherents = Adherent::getGenres($adherents);

        //On construit le tableau avec les datas
        $data[]=[
            'nom_club' => $club[1],
            'hommes' => $adherents['hommes'],
            'femmes' => $adherents['femmes']
        ];
  
        $etape= 8;
    }

}

include($repVues."globals/v_entete.php") ;
include($repVues."globals/v_accueil.php") ;
include($repVues."globals/v_pied.php");