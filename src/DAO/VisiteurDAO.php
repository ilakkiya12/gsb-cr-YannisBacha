<?php

namespace GSB\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use GSB\Domain\Visiteur;

class VisiteurDAO extends DAO implements UserProviderInterface
{
    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id The user id.
     *
     * @return \GSB\Domain\User|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from visiteur where id_visiteur=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Aucun visiteur avec l'id " . $id);
    }

    /**
     * {@inheritDoc}
     * loadUserByUsername
     */
    public function loadUserByUsername($login)
    {
        $sql = "select * from visiteur where login_visiteur=?";
        $row = $this->getDb()->fetchAssoc($sql, array($login));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('Visiteur "%s" inconnu .', $login));
    }

    /**
     * {@inheritDoc}
     * refreshUser
     */
    public function refreshUser(UserInterface $visiteur)
    {
        $class = get_class($visiteur);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($visiteur->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'GSB\Domain\Visiteur' === $class;
    }

    /**
     * Creates a Visiteur object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \GSB\Domain\Visiteur
     */
    protected function buildDomainObject($row) {
        $visiteur = new Visiteur();
        $visiteur->setId($row['id_visiteur']);
        $visiteur->setNom($row['nom_visiteur']);
        $visiteur->setPrenom($row['prenom_visiteur']);
        $visiteur->setAdresse($row['adresse_visiteur']);
        $visiteur->setCp($row['cp_visiteur']);
        $visiteur->setVille($row['ville_visiteur']);
        $visiteur->setDateEmbauche($row['date_embauche']);
        $visiteur->setUsername($row['login_visiteur']);
        $visiteur->setPassword($row['pwd_visiteur']);
        $visiteur->setSalt($row['salt']);
        $visiteur->setRole($row['role']);
        return $visiteur;
    }
    
     /**
     * Saves a comment into the database.
     *
     * @param \MicroCMS\Domain\Comment $comment The comment to save
     */
    public function save(Visiteur $visiteur) {
        $visiteurData = array(
            'id_visiteur' => $visiteur->getId(),
            'nom_visiteur' => $visiteur->getNom(),
            'prenom_visiteur' => $visiteur->getPrenom(),
            'adresse_visiteur' => $visiteur->getAdresse(),
            'cp_visiteur' => $visiteur->getCp(),
            'ville_visiteur' => $visiteur->getVille(),
            'date_embauche' => $visiteur->getDateEmbauche(),
            'login_visiteur' => $visiteur->getUsername(),
            'pwd_visiteur' => $visiteur->getPassword()
            );

        if ($visiteur->getId()) {
            $this->getDb()->update('visiteur', $visiteurData, array('id_visiteur' => $visiteur->getId()));
        } else {
            $this->getDb()->insert('visiteur', $visiteurData);
            $id = $this->getDb()->lastInsertId();
            $visiteur->setId($id);
        }
    }
}