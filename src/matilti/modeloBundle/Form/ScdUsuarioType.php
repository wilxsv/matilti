<?php

namespace matilti\modeloBundle\Form;
//'years' => range(date('Y') -5, date('Y')),, 'date', array('label'  => 'Nacimiento :', 'widget' => 'single_text', 'attr'=>  array('size' => '15'))
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ScdUsuarioType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username', 'text', array('label'  => 'Alias :','attr'=>  array('size' => '15')))
            ->add('password', 'password', array('label'  => 'Clave :','attr'=>  array('size' => '15')))
            ->add('correousuario', 'email', array('label'  => 'Correo :','attr'=>  array('size' => '15')))
            ->add('detalleusuario', 'text', array('label'  => 'Descripción :'))
            ->add('nombreusuario', 'text', array('label'  => 'Nombre :','attr'=>  array('size' => '15')))
            ->add('apellidousuario', 'text', array('label'  => 'Apellido :','attr'=>  array('size' => '15')))
            ->add('telefonousuario', 'text', array('label'  => 'Telefono :','attr'=>  array('size' => '12')))
            ->add('nacimientousuario', 'date', array('label'  => 'Nacimiento :', 'years' => range(date('Y') -65, date('Y')-10),))
            ->add('latusuario', 'money', array('label'  => 'Latitud :', 'precision' => '5','attr'=>  array('size' => '15')))
            ->add('lonusuario', 'money', array('label'  => 'Longitud :', 'precision' => '5','attr'=>  array('size' => '15')))
            ->add('direccionusuario', 'text', array('label'  => 'Dirección :'))
            ->add('sexousuario', 'choice', array('choices'=> array('1' => 'Femenino', '2' => 'Masculino'), 'required'  => true, 'label'  => 'Sexo :'))
            ->add('cuentausuario', 'text', array('label'  => 'Cuentas :','attr'=>  array('size' => '15', 'value' => '<cuentas><anda>0000</anda></cuentas>')))
            ->add('imagenusuario', 'file', array('label'  => 'Imagen :'))
            ->add('estado')
            ->add('localidad')
            ->add('rol')
            ->add('entidad')

        ;
    }

    public function getName()
    {
        return 'matilti_modelobundle_scdusuariotype';
    }
    
        
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'matilti\modeloBundle\Entity\ScdUsuario',
        );
    }
}
