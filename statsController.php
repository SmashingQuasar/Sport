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
        switch($action)
        {

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
                //On récupere l'âge de chaque adhérent
                foreach($adherents as $adherent){
                    $ages[] = Adherent::getAge($adherent['date_naissance']);
                }
                //On récupére les tranches d'âges
                $tranches = Adherent::getTranchesAges($ages);
                break; 
        }
    }
}

if(!empty($_POST))
{


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
