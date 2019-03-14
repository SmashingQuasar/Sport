<?php
//Elie Bismuth
namespace App;

use PDO;
use App\Cnx;
use Exception;

class Adherent{

    private $id;
    private $prenom;
    private $nom;
    private $dateNaissance;
    private $genre;

    /**
     * Adherent constructor.
     * @param $id
     * @param $prenom
     * @param $nom
     * @param $dateNaissance
     * @param $genre
     */
    public function __construct(int $id, string $prenom, string $nom, $dateNaissance, string $genre)
    {
        $this->id = $id;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->dateNaissance = $dateNaissance;
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPrenom() : ?string
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getNom() : ?string
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param mixed $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @return mixed
     */
    public function getGenre() : ?string
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre(string $genre)
    {
        $this->genre = $genre;
    }


    /**
     * Récupére tous les adhérents
     *
     * @return array
     */
    public static function getAllAdherents() : ?array
    {
        $connexion = CNX::getInstance();

        if($connexion){

            $sql = 'SELECT * FROM adherents';
            
            $sth = $connexion->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();

            $adherents = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            throw new Exception("Erreur de connexion a la base de données");
        }

        return $adherents;
    }

    /**
     * Liste les adherents a jour
     *
     * @return array
     */
    public static function getAllAdherents_AJour() : ?array
    {
        $connexion = CNX::getInstance();

        if($connexion){

            $sql = 'SELECT DISTINCT adherents.id_adherent, nom, prenom, date_naissance, genre , nom_club , adherents_est_inscrit.date_inscription
                    FROM adherents, clubs, adherents_est_inscrit
                    WHERE adherents.id_adherent = adherents_est_inscrit.id_adherent
                    AND clubs.id_club = adherents_est_inscrit.id_club
                    AND YEAR(date_inscription) = YEAR(CURDATE())
                    ORDER BY nom';
            
            $sth = $connexion->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();

            $adherents = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            throw new Exception("Erreur de connexion a la base de données");
        }

        return $adherents;
    }

    /**
     * Liste les adhérents qui ne sont pas à jour
     *
     * @return array
     */
    public static function getAdherentsNonAJour() :?array
    {
        $connexion = CNX::getInstance();

        if($connexion){

            $sql = 'SELECT DISTINCT adherents.id_adherent, nom, prenom, date_naissance, genre         
                    FROM adherents, clubs, adherents_est_inscrit 
                    WHERE adherents.id_adherent = adherents_est_inscrit.id_adherent
                    AND clubs.id_club = adherents_est_inscrit.id_club
                    AND YEAR(date_inscription) < YEAR(CURDATE()) ';
            
            $sth = $connexion->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $sth->execute();

            $adherents = $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            throw new Exception("Erreur de connexion a la base de données");
        }
        return $adherents;
    }

    public static function getGenres(array $adherents) : ?array
    {
        $nbHommes = 0;
        $nbFemmes= 0 ;
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
        $data=[
            'hommes' => $nbHommes,
            'femmes' => $nbFemmes
        ];

        return $data;
    }

    public static function getAge($dateNaissance)
    {
        $today = new \Datetime(date('m.d.y'));
        $bday = new \DateTime($dateNaissance);

        $value = $today->diff($bday);
        $age = ceil($value->days/365);
        
        return $age;
    }

    public static function getTranchesAges($ages) :?array
    {
        $tranche10 = 0;
        $tranche20 = 0;
        $tranche30 = 0;
        $tranche40 = 0;
        $tranche50 = 0;
        $tranche60 = 0;
        $tranche70 = 0;
        $tranche80 = 0;
        $tranche90 = 0;
        $tranche100 = 0; 

        foreach($ages as $age){

            if($age <= 10){
                $tranche10 = $tranche10 + 1 ;
            }
            elseif($age >10 && $age <=20){
                $tranche20 = $tranche20 + 1;
            }
            elseif($age > 20 && $age <= 30){
                $tranche30 = $tranche30+ 1;
            }
            elseif($age > 30 && $age <= 40){
                $tranche40 = $tranche40 + 1;
            }
            elseif($age > 40 && $age <= 50){
                $tranche50 = $tranche50 + 1;
            }
            elseif($age > 50 && $age <= 60){
                $tranche60 = $tranche60 + 1;
            }
            elseif($age > 60 && $age <= 70){
                $tranche70 = $tranche70 + 1;
            }
            elseif($age > 70 && $age <= 80){
                $tranche80 = $tranche80 + 1;
            }
            elseif($age > 80 && $age <= 90){
                $tranche90 = $tranche90 + 1;
            }
            elseif($age > 90 && $age <= 100){
                $tranche100 = $tranche100 + 1;
            }
        }

        $ages= [
            'tranches10' => $tranche10,
            'tranches20' => $tranche20,
            'tranches30' => $tranche30,
            'tranches40' => $tranche40,
            'tranches50' => $tranche50,
            'tranches60' => $tranche60,
            'tranches70' => $tranche70,
            'tranches80' => $tranche80,
            'tranches90' => $tranche90,
            'tranches100' => $tranche100,
        ];

        return  $ages;
    }



}