<?php

//Elie Bismuth

namespace App;
use PDO;

class AdherentsEstInscrit{


    private $idAdherent;
    private $idClub;
    private $dateInscription;
    private $anneeLicence;

    /**
     * AdherentsEstInscrit constructor.
     * @param $idAdherent
     * @param $idClub
     * @param $dateInscription
     * @param $anneeLicence
     */
    public function __construct($idAdherent, $idClub, $dateInscription, $anneeLicence)
    {
        $this->idAdherent = $idAdherent;
        $this->idClub = $idClub;
        $this->dateInscription = $dateInscription;
        $this->anneeLicence = $anneeLicence;
    }

    /**
     * @return mixed
     */
    public function getIdAdherent() :?int
    {
        return $this->idAdherent;
    }

    /**
     * @param mixed $idAdherent
     */
    public function setIdAdherent(int $idAdherent)
    {
        $this->idAdherent = $idAdherent;
    }

    /**
     * @return mixed
     */
    public function getIdClub() : ?int
    {
        return $this->idClub;
    }

    /**
     * @param mixed $idClub
     */
    public function setIdClub(int $idClub)
    {
        $this->idClub = $idClub;
    }

    /**
     * @return mixed
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * @param mixed $dateInscription
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }

    /**
     * @return mixed
     */
    public function getAnneeLicence()
    {
        return $this->anneeLicence;
    }

    /**
     * @param mixed $anneeLicence
     */
    public function setAnneeLicence($anneeLicence)
    {
        $this->anneeLicence = $anneeLicence;
    }



public static function AjouterInscription($idAdherent, $idClub, $date, $licence ) : ?bool
{
    $connexion = Cnx::getInstance();

    if($connexion){

        $sql = 'INSERT INTO adherents_est_inscrit(id_adherent,id_club,date_inscription, annee_de_licence)                    
                VALUES (:idAdherent, :idClub, :dateInscription, :licence) ';

        $sth = $connexion->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $ok= $sth->execute([
            ':idAdherent' => $idAdherent,
            ':idClub' => $idClub,
            ':dateInscription'=> $date,
            ':licence' => $licence
            ]);
    }
    else{
        throw new Exception("Erreur de connexion a la base de données");
    }

    return $ok ? true : false ;

}

    
}