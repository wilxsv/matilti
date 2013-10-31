<?php

namespace matilti\mensajeriaBundle\Services;

use Doctrine\ORM\EntityManager;
use matilti\modeloBundle\Entity\ScdHistorialOperacion;

class RegistroHistorial
{ 
 private $em;

 public function __construct(EntityManager $entityManager)
 {
        $this->em = $entityManager;
 }
 
 function registrarHistorial($usuarioId, $usuarioIp, $accion){
	$ahora = new \DateTime();	
	$usuario = $this->em->getRepository('modeloBundle:ScdUsuario')->find($usuarioId);
	if ($usuario != null) 
		$detalle = $usuario->getUsername().$accion;
	else
		return 'Usuario no existe, no se guardo registro';

	$registro = new ScdHistorialOperacion();
	$registro->setUsuario($usuario);
	$registro->setFechahisoperacion($ahora);
	$registro->setDetallehisoperacion($detalle);
	$registro->setIpoperacion($usuarioIp);

	$this->em->persist($registro);
  	$this->em->flush($registro);

	return 'Accion registrada exitosamente';
 }
 
}
