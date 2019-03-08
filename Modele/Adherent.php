<?php

namespace App;

use PDO;
use App\Cnx;

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
    public function __construct(int $id, string $prenom, string $nom, date $dateNaissance, string $genre)
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
    public function getDateNaissance() : date
    {
        return $this->dateNaissance;
    }

    /**
     * @param mixed $dateNaissance
     */
    public function setDateNaissance(date $dateNaissance)
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

            $adherents = $sth->fetchAll();
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
            
            $sth = $connexion->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();

            $adherents = $sth->fetchAll();
        }
        return $adherents;
    }




}