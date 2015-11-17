<?php

namespace GSB\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class VisiteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', 'text');
        $builder->add('prenom', 'text');
        $builder->add('adresse', 'text');
        $builder->add('codePostal', 'text');
        $builder->add('ville', 'text');
        $builder->add('dateEmbauche', 'text');
        $builder->add('username', 'text');
    }

    public function getName()
    {
        return 'visiteur';
    }
}