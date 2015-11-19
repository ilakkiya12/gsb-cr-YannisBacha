<?php

namespace GSB\DAO;

use GSB\Domain\RapportVisite;

class RapportVisiteDAO extends DAO 
{
    /**
     * @var \GSB\DAO\PraticienDAO
     */
    private $praticienDAO;

    /**
     * @var \GSB\DAO\VisiteurDAO
     */
    private $visiteurDAO;

    public function setPraticienDAO(PraticienDAO $praticienDAO) {
        $this->praticienDAO = $praticienDAO;
    }

    public function setVisiteurDAO(VisiteurDAO $visiteurDAO) {
        $this->visiteurDAO = $visiteurDAO;
    }


    public function findAllByVisiteur($visiteurId) {
        // The associated praticien is retrieved only once
        $visiteur = $this->visiteurDAO->find($visiteurId);

        $sql = "select * from rapport_visite where id_visiteur=? order by date_rapport";
        $result = $this->getDb()->fetchAll($sql, array($visiteurId));

        // Convert query result to an array of domain objects
        $rapportVisites = array();
        foreach ($result as $row) {
            $rapportId = $row['id_rapport'];
            $rapportVisite = $this->buildDomainObject($row);

            $rapportVisites[$rapportId] = $rapportVisite;
        }
        return $rapportVisites;
    }

    
    /**
     * Creates an rapportVisite object based on a DB row.
     *
     * @param array $row The DB row containing rapportVisite data.
     * @return \GSB\Domain\rapportVisite
     */
    protected function buildDomainObject($row) {
        $rapportVisite = new RapportVisite();
        $rapportVisite->setId($row['id_rapport']);
        $rapportVisite->setDateRapport($row['date_rapport']);
        $rapportVisite->setBilan($row['bilan']);
        $rapportVisite->setMotif($row['motif']);

        if (array_key_exists('id_praticien', $row)) {
            // Find and set the associated praticien
            $praticienId = $row['id_praticien'];
            $praticien = $this->praticienDAO->find($praticienId);
            $rapportVisite->setPraticien($praticien);
        }
        if (array_key_exists('id_visiteur', $row)) {
            // Find and set the associated visiteur
            $visiteurId = $row['id_visiteur'];
            $visiteur = $this->visiteurDAO->find($visiteurId);
            $rapportVisite->setVisiteur($visiteur);
        }
        
        return $rapportVisite;
    }
    
    /**
     * Saves a rapportVisite into the database.
     *
     * @param \GSB\Domain\RapportVisite $rapportVisite The rapportVisite to save
     */
    public function save(RapportVisite $rapportVisite) {
        $rapportVisiteData = array(
            'id_praticien' => $rapportVisite->getPraticien()->getId(),
            'id_visiteur' => $rapportVisite->getVisiteur()->getId(),
            'date_rapport' => $rapportVisite->getDateRapport(),
            'bilan' => $rapportVisite->getBilan(),
            'motif' => $rapportVisite->getMotif()
            );

        if ($rapportVisite->getId()) {
            // The rapportVisite has already been saved : update it
            $this->getDb()->update('rapport_visite', $rapportVisiteData, array('id_rapport' => $rapportVisite->getId()));
        } else {
            // The rapportVisite has never been saved : insert it
            $this->getDb()->insert('rapport_visite', $rapportVisiteData);
            // Get the id of the newly created rapportVisite and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $rapportVisite->setId($id);
        }
    }

}