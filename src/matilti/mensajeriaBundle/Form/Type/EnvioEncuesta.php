<?php

namespace matilti\mensajeriaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Symfony\Component\Validator\Constraints\MaxLength;
use Symfony\Component\Validator\Constraints\Min;
use Symfony\Component\Validator\Constraints\Max;
use Symfony\Component\Validator\Constraints\Collection;

class EnvioEncuesta extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
	$builder->add('pregunta','textarea', array('label' => 'Pregunta: ', 'max_length' => 160 ));
	
	$builder->add('respuestas','text', array('label' => "Ingrese las respuestas esperadas, separadas por comas (,): ", ));

	//$builder->add('masivo', 'checkbox', array('label' => '¿Enviar a todos los usuarios?', 'required' => false, ));

	$builder->add('localidad', 'entity', array('class' => 'modeloBundle:ScdLocalidad', 'property' => 'nombrelocalidad', 'label' => 'Comunidad: ',));

	$builder->add('minEdad', 'integer', array('label' => 'Edad Minima: ', ));

	$builder->add('maxEdad', 'integer', array('label' => 'Edad Maxima: ', ));

	$builder->add('genero', 'choice', array('label' => 'Genero: ', 'choices'   => array('0' => 'Femenino', '1' => 'Masculino', '2' => 'No filtrar por genero'), 'preferred_choices' => array('2'), ));

    }

    public function getName()
    {
        return 'EnvioMensaje';
    }

    public function getDefaultOptions(array $options)
    {
	$collectionConstraint = new Collection(array(
	'fields' => array(
		'pregunta' => new MaxLength(array(
			'limit' => 160, 
			'message' => 'Debe contener 160 caracteres o menos', 
						)
					  ),
		'minEdad' => array(
				new Min(array(
				'limit' => 1, 
				'message' => 'La edad minima no es valida, debe ser mayor o igual a 1', )),
				new Max(array(
				'limit' => 98, 
				'message' => 'La edad minima no es valida, debe ser menor o igual a 98', ))
			),
		'maxEdad' => array(
				new Min(array(
				'limit' => 2, 
				'message' => 'La edad maxima no es valida, debe ser mayor o igual a 2', )), 
				new Max(array(
				'limit' => 99, 
				'message' => 'La edad maxima no es valida, debe ser menor o igual a 99', )),
			)),
	'allowExtraFields' => true,
	));
        return array('validation_constraint' => $collectionConstraint);
    }
	
}
