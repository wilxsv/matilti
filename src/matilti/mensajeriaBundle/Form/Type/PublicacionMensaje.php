<?php

namespace matilti\mensajeriaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Doctrine\ORM\EntityRepository;

class PublicacionMensaje extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
	$builder->add('mensaje', 'entity', array('class' => 'modeloBundle:ScdRecibido',
			'property' => 'mensajerecibido', 'label' => 'Mensaje: ', ));
    }
   
    public function getName()
    {
        return 'publicacionMensaje';
    }
}
