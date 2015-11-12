<?php

namespace GSB\DAO;

use GSB\Domain\Praticien;

class PraticienDAO extends DAO
{
    /**
     * @var \GSB\DAO\TypePraticienDAO
     */
    private $typePraticienDAO;

    public function setTypePraticienDAO(TypePraticienDAO $typePraticienDAO) {
        $this->typePraticienDAO = $typePraticienDAO;
    }

    /**
     * Renvoie la liste de tous les praticiens, triés par nom
     *
     * @return array La liste de tous les praticiens
     */
    public function findAll() {
        $sql = "select * from praticien order by nom_praticien";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $praticiens = array();
        foreach ($result as $row) {
            $praticienId = $row['id_praticien'];
            $praticiens[$praticienId] = $this->buildDomainObject($row);
        }
        return $praticiens;
    }

    /**
     * Renvoie la liste de tous les praticiens appartenant à un type de praticien
     *
     * @param integer $typePraticienId L'identifiant du TypePraticien
     *
     * @return array La liste des praticiens
     */
    public function findAllByTypePraticien($typePraticienId) {
        $sql = "select * from praticien where id_type_praticien=? order by nom_praticien";
        $result = $this->getDb()->fetchAll($sql, array($typePraticienId));
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $praticiens = array();
        foreach ($result as $row) {
            $praticienId = $row['id_praticien'];
            $praticiens[$praticienId] = $this->buildDomainObject($row);
        }
        return $praticiens;
    }
    
    
    /**
     * Renvoie la liste de tous les praticiens avec le nom et la ville
     *
     * @param string $nom Nom du praticien
     * @param string $ville Ville du praticien
     *
     * @return array La liste des praticiens
     */
    public function findAllByNomVille($nom, $ville) {
        $sql = "select * from praticien where id_praticien IN 
        (select id_praticien from praticien where nom_praticien LIKE ?)
        AND id_praticien IN
        (select id_praticien from praticien where ville_praticien LIKE ?)
        order by nom_praticien;";
        
        $result = $this->getDb()->fetchAll($sql, array('%'. $nom .'%','%'. $ville .'%'));
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $praticiens = array();
        foreach ($result as $row) {
            $praticienId = $row['id_praticien'];
            $praticiens[$praticienId] = $this->buildDomainObject($row);
        }
        return $praticiens;
    }

    /**
     * Renvoie un praticien à partir de son identifiant
     *
     * @param integer $id L'identifiant du praticien
     *
     * @return \GSB\Domain\Praticien|Lève un exception si aucun praticien ne correspond
     */
    public function find($id) {
        $sql = "select * from praticien where id_praticien=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun praticien ne correspond à l'identifiant " . $id);
    }

    /**
     * Crée un objet Praticien à partir d'une ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \GSB\Domain\Praticien
     */
    protected function buildDomainObject($row) {
        $praticien = new Praticien();
        $praticien->setId($row['id_praticien']);
        $praticien->setNom($row['nom_praticien']);
        $praticien->setPrenom($row['prenom_praticien']);
        $praticien->setAdresse($row['adresse_praticien']);
        $praticien->setCp($row['cp_praticien']);
        $praticien->setVille($row['ville_praticien']);
        $praticien->setCoefNotoriete($row['coef_notoriete']);

        if (array_key_exists('id_type_praticien', $row)) {
            // Trouve et définit le type de praticien associé
            $typePraticienId = $row['id_type_praticien'];
            $typePraticien = $this->typePraticienDAO->find($typePraticienId);
            $praticien->setTypePraticien($typePraticien);
        }
   
        return $praticien;
    }
}