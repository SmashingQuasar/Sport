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

            $sql = 'SELECT DISTINCT id_adherent, nom, prenom, date_naissance, genre                     
                    FROM adherents
                    WHERE adherents.id_adherent NOT IN (
                        SELECT adherents.id_adherent
                        FROM adherents, adherents_est_inscrit
                        WHERE adherents.id_adherent = adherents_est_inscrit.id_adherent)
                    ORDER BY nom';
            
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

    public static function getTranchesAges($ages)
    {
        foreach($ages as $age){
            $tranche[] = [
                '10' => $age <10 ? $age : null,
                '20' => $age <20 ? $age : null,
                '30' => $age <30 ? $age : null,
                '40' => $age <40 ? $age : null,
                '50' => $age <50 ? $age : null,
                '60' => $age <60 ? $age : null,
                '70' => $age <70 ? $age : null,
                '80' => $age <80 ? $age : null,
            ];
        }
    }



}