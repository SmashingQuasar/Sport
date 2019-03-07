<?php

namespace App;

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
    public function __construct(integer $idAdherent, integer $idClub, date $dateInscription, date $anneeLicence)
    {
        $this->idAdherent = $idAdherent;
        $this->idClub = $idClub;
        $this->dateInscription = $dateInscription;
        $this->anneeLicence = $anneeLicence;
    }

    /**
     * @return mixed
     */
    public function getIdAdherent() :?integer
    {
        return $this->idAdherent;
    }

    /**
     * @param mixed $idAdherent
     */
    public function setIdAdherent(integer $idAdherent)
    {
        $this->idAdherent = $idAdherent;
    }

    /**
     * @return mixed
     */
    public function getIdClub() : ?integer
    {
        return $this->idClub;
    }

    /**
     * @param mixed $idClub
     */
    public function setIdClub(integer $idClub)
    {
        $this->idClub = $idClub;
    }

    /**
     * @return mixed
     */
    public function getDateInscription() : ?date
    {
        return $this->dateInscription;
    }

    /**
     * @param mixed $dateInscription
     */
    public function setDateInscription(date $dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }

    /**
     * @return mixed
     */
    public function getAnneeLicence() : ?date
    {
        return $this->anneeLicence;
    }

    /**
     * @param mixed $anneeLicence
     */
    public function setAnneeLicence(date $anneeLicence)
    {
        $this->anneeLicence = $anneeLicence;
    }

    


}