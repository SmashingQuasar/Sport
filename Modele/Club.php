<?php
//Elie Bismuth

namespace App;

use PDO;
use App\Cnx;
use Exception;

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

            $sql = 'SELECT *                    
                    FROM clubs';
    
            $sth = $connexion->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute();

            $clubs = $sth->fetchAll(PDO::FETCH_ASSOC);

        }
        else{
            throw new Exception("Erreur de connexion a la base de données");
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

            $adherents = $sth->fetchAll(PDO::FETCH_ASSOC);

        }
        else{
            throw new Exception("Erreur de connexion a la base de données");
        }

        return $adherents;
    }

    public static function AjouterAdherent(string $prenom, string $nom, $dateNaissance, string $genre) : ?bool
    {
        $connexion = Cnx::getInstance();

        if($connexion){

            $sql = 'INSERT INTO adherents(prenom,nom,date_naissance,genre)                    
                    VALUES (:prenom, :nom, :date_naissance, :genre) ';

            $sth = $connexion->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $ok= $sth->execute([
                ':prenom' => $prenom,
                ':nom' => $nom,
                ':date_naissance'=> $dateNaissance,
                ':genre' => $genre
                ]);
        }
        else{
            throw new Exception("Erreur de connexion a la base de données");
        }

        return $ok ? true : false ;

    }

    



}