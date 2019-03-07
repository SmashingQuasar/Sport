<?php

namespace App;

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



}