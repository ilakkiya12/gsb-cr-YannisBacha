<?php

namespace GSB\Domain;

class RapportVisite 
{
    /**
     * Identifiant.
     *
     * @var integer
     */
    private $id;

    /**
     * Date du rapport.
     *
     * @var DateTime
     */
    private $dateRapport;
    
    /**
     * Bilan.
     *
     * @var string
     */
    private $bilan;
    
    /**
     * Motif.
     *
     * @var string
     */
    private $motif;
    
     /**
     * Rapport Visiteur.
     *
     * @var \GSB\Domain\Visiteur
     */
    private $visiteur;
    
    public function getVisiteur() {
        return $this->visiteur;
    }    
    public function setVisiteur(Visiteur $visiteur) {
        $this->visiteur = $visiteur;
    }
    
    /**
     * Rapport Praticien.
     *
     * @var \GSB\Domain\Praticien
     */
    private $praticien;
    
    public function getPraticien() {
        return $this->praticien;
    }    
    public function setPraticien(Praticien $praticien) {
        $this->praticien = $praticien;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDateRapport()
    {
        return $this->dateRapport;
    }

    public function setdateRapport($date) {
        $this->dateRapport = $date;
    }
    
    public function getBilan() {
        return $this->bilan;
    }

    public function setBilan($bilan) {
        $this->bilan = $bilan;
    }
    
     public function getMotif() {
        return $this->motif;
    }

    public function setMotif($motif) {
        $this->motif = $motif;
    }
}