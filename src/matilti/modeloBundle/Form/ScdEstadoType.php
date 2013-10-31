<?php

namespace matilti\modeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ScdEstadoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombreestado', 'text', array('label'  => 'Nombre',))
            ->add('detalleestado', 'textarea', array('label'  => 'Descripción',))
        ;
    }

    public function getName()
    {
        return 'matilti_modelobundle_scdestadotype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'matilti\modeloBundle\Entity\ScdEstado',
        );
    }
}
