<?php

namespace matilti\modeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ScdEntidadType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombreentidad', 'text', array('label'  => 'Nombre :','attr'=>  array('size' => '15')))
            ->add('correoentidad', 'email', array('label'  => 'Correo :', 'required'  => false, 'attr'=>  array('size' => '15')))
            ->add('telefonoentidad','text', array('label'  => 'Telefono :', 'required'  => false,'attr'=>  array('size' => '12')))
            ->add('urlentidad')
            ->add('xmlentidad')
            ->add('latentidad')
            ->add('lonentidad')
            ->add('localidad')
        ;
    }

    public function getName()
    {
        return 'matilti_modelobundle_scdentidadtype';
    }
}
