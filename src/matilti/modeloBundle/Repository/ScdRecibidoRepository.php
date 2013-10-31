<?php

namespace matilti\modeloBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ScdRecibidoRepository extends EntityRepository
{
    public function mensajesEncuesta($encuesta)
    {
	$activa = $encuesta->getEncuestaActiva();
	$hInicio = $encuesta->getFechahorainicio();
	if ($activa == 1)
		$hFin = new \DateTime();
	else
		$hFin = $encuesta->getFechahorafin();

	$regla = $this->getEntityManager()->getRepository('modeloBundle:ScdReglaSms')->findOneByPrefijoregla('encuesta');

	$mensajes = $this->getEntityManager()
            		->createQuery('SELECT m FROM modeloBundle:ScdRecibido m WHERE m.regla = :regla
				       AND m.fechahorarecibido > :hInicio AND m.fechahorarecibido < :hFin')
			->setParameters(array(
				'hInicio' => $hInicio,
				'hFin' => $hFin,
				'regla' => $regla))
           		->getResult();
	return $mensajes;
    }
}
