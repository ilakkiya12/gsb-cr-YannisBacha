<?php

namespace GSB\Domain;

class TypePraticien 
{
    /**
     * Identifiant.
     *
     * @var integer
     */
    private $id;

    /**
     * Libelle.
     *
     * @var string
     */
    private $libelle;
    
    /**
     * Lieu.
     *
     * @var string
     */
    private $lieu;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
    
    public function getLieu() {
        return $this->lieu;
    }

    public function setLieu($lieu) {
        $this->lieu = $lieu;
    }
}