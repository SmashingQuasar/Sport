<?php

namespace App;

use PDO;
use App\Cnx;

class Club{


    private $id;
    private $nom;
    private $codePostal;
    private $ville;

    /**
     * Club constructor.
     * @param $id
     * @param $nom
     * @param $codePostal
     * @param $ville
     */
    public function __construct( int $id, string $nom, int $codePostal, string $ville)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
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
    public function getCodePostal() : ?int
    {
        return $this->codePostal;
    }

    /**
     * @param mixed $codePostal
     */
    public function setCodePostal(int $codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return mixed
     */
    public function getVille() : ?string
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille( string $ville)
    {
        $this->ville = $ville;
    }

    /**
     * Retourne tous les clubs
     *
     * @return array
     */
    public static function getClubs() : ?array
    {
        $connexion = Cnx::getInstance();

        if($connexion){

            $sql = 'SELECT id_club, nom_club                     
                    FROM clubs';
    
            $sth = $connexion->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();

            $clubs = $sth->fetchAll();
        }

        return $clubs;
    }
    

    /**
     * Retourne les adhérents d'un club
     *
     * @param int $club
     *
     * @return array
     */
    public static function getAdherents(int $club) : ?array
    {
        $connexion = Cnx::getInstance();

        if($connexion){

            $sql = 'SELECT DISTINCT adherents.id_adherent, nom, prenom, date_naissance, genre                        
                    FROM adherents, adherents_est_inscrit
                    WHERE adherents.id_adherent = adherents_est_inscrit.id_adherent
                    AND adherents_est_inscrit.id_club = :club';

            $sth = $connexion->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute([':club' => $club]);

            $clubs = $sth->fetchAll();
        }

        return $clubs;
    }



}