<?php

namespace GSB\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class Visiteur implements UserInterface
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
    private $codePostal;

    /**
     * Ville.
     *
     * @var string
     */
    private $ville;

    /**
     * Date embauche.
     *
     * @var date
     */
    private $dateEmbauche;
    
    /**
     * username.
     *
     * @var string
     */
    private $username;

    /**
     * Mot de passe.
     *
     * @var string
     */
    private $password;

    /**
     * Salt.
     *
     * @var string
     */
    private $salt;

    /**
     * Role.
     * Valeurs : ROLE_USER ou ROLE_ADMIN.
     *
     * @var string
     */
    private $role;

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

    public function getCodePostal() {
        return $this->codePostal;
    }

    public function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;
    }

    public function getVille() {
        return $this->ville;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }
    
    public function getDateEmbauche() {
        return $this->dateEmbauche;
    }
    
    public function setDateEmbauche($date) {
        $this->dateEmbauche = $date;   
    }
    
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function getRoles()
    {
        return array($this->getRole());
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }
}