<?php

namespace matilti\mensajeriaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Doctrine\ORM\EntityRepository;



class ConsultarEncuesta extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
	$builder->add('encuesta', 'entity', array('class' => 'modeloBundle:ScdEncuesta',
			'property' => 'mensajeencuesta', 'label' => 'Encuesta: ', ));
	
    }
   
    public function getName()
    {
        return 'consultarEncuesta';
    }
}
