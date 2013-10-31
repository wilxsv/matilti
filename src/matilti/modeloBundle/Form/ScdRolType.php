<?php

namespace matilti\modeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ScdRolType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombrerol', 'text', array('label'  => 'Nombre',))
            ->add('detallerol', 'textarea', array('label'  => 'Descripción',))
        ;
    }

    public function getName()
    {
        return 'matilti_modelobundle_scdroltype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'matilti\modeloBundle\Entity\ScdRol',
        );
    }
}
