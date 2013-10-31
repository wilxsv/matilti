<?php

namespace matilti\modeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ScdReglaSmsType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombreregla', 'text', array('label'  => 'Nombre :','attr'=>  array('size' => '15')))
            ->add('prefijoregla', 'text', array('label'  => 'Prefijo :','attr'=>  array('maxlength' => '10', 'size' => '10')))
            ->add('inicioregla', 'datetime', array('label'  => 'Inicio :', 'widget' => 'single_text', 'attr'=>  array('size' => '15')))
            ->add('finregla', 'datetime', array('label'  => 'Fin :', 'widget' => 'single_text', 'attr'=>  array('size' => '15')))
            ->add('descripcionregla', 'text', array('label'  => 'Descripción :',))
            ->add('rol', 'entity',
						array('class' => 'modeloBundle:ScdRol', 'required' => true, 'multiple' => true))
        ;
    }

    public function getName()
    {
        return 'matilti_modelobundle_scdreglasmstype';
    }
}
