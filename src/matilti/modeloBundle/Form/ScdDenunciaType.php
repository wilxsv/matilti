<?php

namespace matilti\modeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ScdDenunciaType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('mensajedenuncia')
            ->add('fechahorainicio')
            ->add('fechahorafin')
            ->add('denunciaactiva')
            ->add('denuncia')
            ->add('usuario')
            ->add('entidad')
        ;
    }

    public function getName()
    {
        return 'matilti_modelobundle_scddenunciatype';
    }
}
