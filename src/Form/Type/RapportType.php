<?php

namespace GSB\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class RapportType extends AbstractType
{
    private $praticiens;
    
    public function __construct($praticiens) {
        $this->praticiens = $praticiens;
    }
    
    
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        // $this->praticiens contient un tableau d'objets Praticiens
        // Transforme le tableau id => objet en un tableau chaîne => id pour la liste déroulante
        $choices = array();
        foreach ($this->praticiens as $id => $praticien) {
          $cle = $praticien->__toString();
          $choices[$cle] = $id;
        }

        $builder->add('praticien', 'choice', array(
          'choices' => $choices,
          'choices_as_values' => true, // Future valeur par défaut dans Symfony 3.x
          'choice_value' => function ($choice) {
            return $choice;
          },
          'expanded' => false, 
          'multiple' => false,
          'mapped' => false  // ce champ n'est pas mis en correspondance avec la propriété de l'objet
        ));
        $builder->add('dateRapport', 'date', array(
                'widget' => 'single_text',    // Pour rendre le champ comme un input de type 'date'
            ));
        $builder->add('motif','textarea');
        $builder->add('bilan','textarea');
    }

    public function getName()
    {
        return 'rapport';
    }
}