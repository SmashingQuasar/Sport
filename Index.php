<?php
//Elie Bismuth

require  __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$repVues = __DIR__ . DIRECTORY_SEPARATOR .'Views/';

use App\Club;
use App\Adherent;
use App\AdherentsEstInscrit;
use App\Cnx;
use App\OpenWeather;
use App\ApiGeo;


$action = !empty($_GET['action']) ? $_GET['action'] : 'homepage' ;

//Les variables $etape sont utilisées dans la vue v_accueil afin de déterminer la vue a appeler
switch($action)
{
    case 'homepage':
        $etape = 0;
        break;

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
        if(!empty($_POST)){
            $idClub = $_POST['selectedClub'];
            $adherentsClub = Club::getAdherents( (int) $idClub);
        }
        break;

    case 'ajouterAdherent' :
        $clubs = Club::getClubs();
        $etape = 4;
        if(!empty($_POST)){
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
        break;

    case 'statGlobal':
        $etape = 5 ; 
        $adherents = Adherent::getAllAdherents();
        $adherents = Adherent::getGenres($adherents);
        $nbTotal= $adherents['hommes'] + $adherents['femmes'];
        break;

    case 'statClubs':
        $etape = 6 ; 
        $clubs = Club::getClubs();
        if(!empty($_POST)){
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
        }
        break;
    
    case 'statAges':
        $etape = 7 ;
        $adherents = Adherent::getAllAdherents();
        //On récupere l'âge de chaque adhérent
        foreach($adherents as $adherent){
            $ages[] = Adherent::getAge($adherent['date_naissance']);
        }
        //On récupére les tranches d'âges
        $tranches = Adherent::getTranchesAges($ages);
        break; 
    
    case 'meteo' :
        $etape = 8;
        $error = null;
        
        //Instancation de OpenWeather avec l'ApiKey donné par l'Api lors de la création d'un compte
        $meteo = new OpenWeather("570906fdd9e00f22e3a55df82c32a992");
        $departements = ApiGeo::getDepartements();
        if(!empty($_POST['selectedDepartement']))
        {
            $departement = $_POST['selectedDepartement'];
            $communes = ApiGeo::getCommunes($departement);
        }
        if(!empty($_POST['selectedCommune']))
        {
            $commune = $_POST['selectedCommune'];
            try{
                $forecast = $meteo->getForecast($commune);
                $today = $meteo->getToday($commune);
            } catch(Exception $e){
                $error = $e->getMessage();
            }
            
        }
        break;
}

include($repVues."globals/v_entete.php") ;
include($repVues."globals/v_accueil.php") ;
include($repVues."globals/v_pied.php");