<?php

namespace matilti\mensajeriaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Validator\Constraints\MaxLength;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContestarMensaje extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {

	$builder->add('respuesta','textarea', array('label' => 'Respuesta: ', ));	
    }

    public function getDefaultOptions(array $options)
    {
	$collectionConstraint = new Collection(array(
	'fields' => array(
		'respuesta' => array(
			new MaxLength(array(
			'limit' => 160, 
			'message' => 'Debe contener 160 caracteres o menos', 
						)
					  ),
			new NotBlank(array(
                    	'message' => 'Debe ingresar texto',
               		 )),
			), ),
	'allowExtraFields' => true,
	'allowMissingFields' => true,
    	));
        return array('validation_constraint' => $collectionConstraint);
    }
	
   
    public function getName()
    {
        return 'contestarMensaje';
    }
}
