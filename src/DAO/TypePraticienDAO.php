<?php

namespace GSB\DAO;

use GSB\Domain\TypePraticien;

class TypePraticienDAO extends DAO
{
    /**
     * Renvoie la liste de touts les TypePraticiens, triés par libellé
     *
     * @return array La liste de touts les TypePraticien
     */
    public function findAll() {
        $sql = "select * from type_praticien order by lib_type_praticien";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convertit les résultats de requête en tableau d'objets du domaine
        $typePraticiens = array();
        foreach ($result as $row) {
            $typePraticienId = $row['id_type_praticien'];
            $typePraticiens[$typePraticienId] = $this->buildDomainObject($row);
        }
        return $typePraticiens;
    }

    /**
     * Renvoie un TypePraticien à partir de son identifiant
     *
     * @param integer $id L'identifiant du TypePraticien
     *
     * @return \GSB\Domain\TypePraticien|Lève une exception si aucun TypePraticien ne correspond
     */
    public function find($id) {
        $sql = "select * from type_praticien where id_type_praticien=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun TypePraticien ne correspond à l'identifiant " . $id);
    }

    /**
     * Crée un objet TypePraticien à partir d'un ligne de résultat BD
     *
     * @param array $row La ligne de résultat BD
     *
     * @return \GSB\Domain\TypePraticien
     */
    protected function buildDomainObject($row) {
        $typePraticien = new TypePraticien();
        $typePraticien->setId($row['id_type_praticien']);
        $typePraticien->setLibelle($row['lib_type_praticien']);
        $typePraticien->setLieu($row['lieu_type_praticien']);
        return $typePraticien;
    }
}