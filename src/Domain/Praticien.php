<?php

namespace GSB\Domain;

class Praticien 
{
    /**
     * Identifiant.
     *
     * @var integer
     */
    private $id;

    /**
     * Nom.
     *
     * @var string
     */
    private $nom;

    /**
     * Prenom.
     *
     * @var string
     */
    private $prenom;

    /**
     * Adresse.
     *
     * @var string
     */
    private $adresse;

    /**
     * Code postal.
     *
     * @var string
     */
    private $cp;

    /**
     * Ville.
     *
     * @var string
     */
    private $ville;

    /**
     * Coefficient de notoriété.
     *
     * @var float
     */
    private $coefNotoriete;

    /**
     * Type_Praticien.
     *
     * @var \GSB\Domaine\Type_Praticien
     */
    private $typePraticien;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getnom() {
        return $this->nom;
    }

    public function setnom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function getCp() {
        return $this->cp;
    }

    public function setCp($cp) {
        $this->cp = $cp;
    }

    public function getVille() {
        return $this->ville;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    public function getCoefNotoriete() {
        return $this->coefNotoriete;
    }

    public function setCoefNotoriete($coefNotoriete) {
        $this->coefNotoriete = $coefNotoriete;
    }

    public function getTypePraticien() {
        return $this->typePraticien;
    }

    public function setTypePraticien(TypePraticien $typePraticien) {
        $this->typePraticien = $typePraticien;
    }
    
    public function __toString() {
        return $this->getPrenom().' '.$this->getNom();    
    }
}