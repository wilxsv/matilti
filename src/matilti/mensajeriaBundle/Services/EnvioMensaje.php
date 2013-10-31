<?php

namespace matilti\mensajeriaBundle\Services;

use Doctrine\ORM\EntityManager;
use matilti\modeloBundle\Entity\ScdEnviado;
use matilti\modeloBundle\Entity\ScdEncuesta;
use Symfony\Component\Serializer\Serializer\Encoder;



class EnvioMensaje
{ 
 private $em;
 private $container;

 public function __construct(EntityManager $entityManager, $serviceContainer)
 {
        $this->em = $entityManager;
	$this->container = $serviceContainer;
 }

 function envioMasivo($mensaje, $encuesta=0) {
 	$cantidad = 0;
	$usuarios = $this->em->getRepository('modeloBundle:ScdUsuario')->findAllActivos();
	foreach ($usuarios as $user) {			
		$numero=$user->getTelefonousuario();					
		$this->enviarMensaje($mensaje, $numero, $encuesta);		
		$cantidad = $cantidad + 1;
	}
	
	if ($cantidad > 0)
		$accion = ' ha enviado un mensaje masivo';
		$this->registrarAccion($accion);

	return $cantidad;
 }
  
 function enviarMensaje($mensaje, $numero, $encuestaId=0, $respuestaId=0) {
	$ahora = new \DateTime();
	$msj = new ScdEnviado();
	$msj->setMensajeenviado($mensaje);
	$msj->setFechahoraenviado($ahora);
	if (strstr($numero,"+503"))
		$numero = substr($numero,3);
			
	$usuario = $this->em->getRepository('modeloBundle:ScdUsuario')->findOneByTelefonousuario($numero);
	$msj->setUsuario($usuario); 

	if ($encuestaId >0){
		$encuesta = $this->em->getRepository('modeloBundle:ScdEncuesta')->findOneById($encuestaId);
		$msj->setEncuesta($encuesta);	
	}
	if ($respuestaId >0){
		$respuesta = $this->em->getRepository('modeloBundle:ScdRecibido')->findOneById($respuestaId);
		$msj->setRespuesta($respuesta);	
		$this->registrarAccion(' ha respondido un mensaje');
	}		
	$this->em->persist($msj);
  	$this->em->flush($msj);
 }
 
 function envioFiltrado($localidad, $minEdad, $maxEdad, $generoForm, $mensaje, $encuesta = 0) {
 	$cantidad = 0;
	$ahora = new \DateTime();	
	$usuarios = $this->em->getRepository('modeloBundle:ScdUsuario')
			->findByFiltros($localidad, $generoForm);
	foreach ($usuarios as $user) {
		$fechanac = $user->getNacimientousuario();  //calculo de edad			
		$edad = $ahora->diff($fechanac);
		$edad = (integer)$edad->y;		   // /calculo de edad
		if ($edad >= $minEdad and $edad <= $maxEdad) { 				
			$numero=$user->getTelefonousuario();	
			$this->enviarMensaje($mensaje, $numero, $encuesta);
			$cantidad = $cantidad + 1;									
		}			 
	}
	if ($encuesta != 0)
		$accion = ' ha enviado una encuesta';
	else
		$accion = ' ha enviado un mensaje filtrado';

	$this->registrarAccion($accion);

	return $cantidad;
 }

 function registrarAccion($accion) {
/*	$id = $this->container->get('security.context')->getToken()->getUser()->getId();
	$id = 14;
	$ip = $this->container->get('request')->getClientIp();
 	$this->container->get('registro_historial')->registrarHistorial($id, $ip, $accion);*/
 }

 function webService($xml) {
	$xml = new \SimpleXMLElement($xml);
	$resultado = 0;
	$operacion = $xml->operacion;	
	$userX = $xml->credenciales->usuario;
	$firmaX = $xml->credenciales->firma;
	$user = $this->em->getRepository('modeloBundle:ScdUsuario')->findOneByUsername($userX);
	if ($user->getId() > 0) {
		$pass = $user->getPassword();
		if ($firmaX == $pass) {
		switch ($operacion) {
			case 'respuesta':
				$numero = $xml->respuesta->telefono;
				$usuario = count($this->em->getRepository('modeloBundle:ScdUsuario')->findOneByTelefonousuario($numero));
				if ($usuario > 0){
					$mensaje = $xml->respuesta->mensaje;
					$this->enviarMensaje($mensaje, $numero);
					$resultado = 1;
				} else
					$resultado = 3;
				break;
			case 'envio':
				$localidad = $xml->envio->parametros->Localidad;
				$minEdad = $xml->envio->parametros->edadinicial;
				$maxEdad = $xml->envio->parametros->edadfin;
				$genero = $xml->envio->parametros->sexo;
				$mensaje = $xml->envio->mensaje;
				$resultado = $this->envioWebService($localidad, $minEdad, $maxEdad, $genero, $mensaje);
				break;
			case 'pregunta':
				$localidad = $xml->pregunta->parametros->Localidad;
				$minEdad = $xml->pregunta->parametros->edadinicial;
				$maxEdad = $xml->pregunta->parametros->edadfin;
				$genero = $xml->pregunta->parametros->sexo;
				$pregunta = $xml->pregunta->pregunta;
				$respuestas = $xml->pregunta->respuestas;
				$encuesta = $this->crearEncuesta($pregunta, $respuestas);
				$resultado = $this->envioWebService($localidad, $minEdad, $maxEdad, $genero, $pregunta, $encuesta);
				break;
			case 'consulta':
				$fechainicial = $xml->consulta->fechainicial;
				$fechafinal = $xml->consulta->fechafinal;
				$localidad = $xml->consulta->localidad;
				$reglaplicada = $xml->consulta->reglaplicada;
				$texto = $xml->consulta->texto;
				$denunciasSel = array();
				$denuncias = $this->em->getRepository('modeloBundle:ScdDenuncia')->denunciasFiltradas($fechainicial, $fechafinal, $reglaplicada);
				foreach ($denuncias as $denuncia) {
					$usuario = $this->em->getRepository('modeloBundle:ScdUsuario')->findOneByTelefonousuario($denuncia->getRemitentedenuncia());
					$localidadU = $usuario->getLocalidad()->getId();
					$mensaje = trim(strstr(strtoupper($denuncia->getMensajedenuncia()), " "));
					$texto = trim(strtoupper($texto));
					similar_text($texto,$mensaje,$porcentaje);
					if ($porcentaje > 90 and $localidadU == $localidad) {
						$denunciasSel[] = $mensaje;}}
				$r = '';				
				foreach ($denunciasSel as $denuncia) {
					$r = "$r<denuncia>$denuncia</denuncia>";
				}
				break;
			default:
				$resultado = 2;
				break;
				}}}		
	if ($operacion == "consulta") {
	    $xml = new \SimpleXMLElement("<matilti><denuncias>$r</denuncias></matilti>");
	} else
	    $xml = new \SimpleXMLElement("<matilti><trackid>$resultado</trackid></matilti>");

	return $xml;
 }

 function enviarEncuesta($pregunta, $respuestas, $localidad, $minEdad, $maxEdad, $genero) {
			$encuestaId = $this->crearEncuesta($pregunta, $respuestas);		
			$cantidad = $this->envioFiltrado($localidad, $minEdad, $maxEdad, $genero, $pregunta, $encuestaId);
			if ($cantidad > 0)
				$resultado = 'Encuesta enviada exitosamente';
			else {
				$encuesta = $this->em->getRepository('modeloBundle:ScdEncuesta')->find($encuestaId);
				$this->em->remove($encuesta);
				$this->em->flush($encuesta);
				$resultado = 'No existen usuarios que cumplan las condiciones establecidas, gracias.'; } 
	return $resultado;
 }

 function crearEncuesta($pregunta, $respuestas) {
	$ahora = new \DateTime(); 	
	$encuestaActiva = $this->em->getRepository('modeloBundle:ScdEncuesta')->findOneByEncuestaactiva(1);
			if ($encuestaActiva != null) {
				$encuestaActiva->setFechahorafin($ahora);
				$encuestaActiva->setEncuestaactiva(0);			
	  			$this->em->flush($encuestaActiva); }
			$encuesta = new ScdEncuesta();
			$encuesta->setMensajeencuesta($pregunta);
			$encuesta->setRespuestasencuesta($respuestas);
			$encuesta->setFechahorainicio($ahora);
			$encuesta->setEncuestaactiva(1);			
			$this->em->persist($encuesta);
	  		$this->em->flush($encuesta);
	return $encuesta->getId();
 }

 function envioWebService($localidad, $minEdad, $maxEdad, $genero, $mensaje, $encuesta=0) {
		if ($genero == "" and $maxEdad == "" and $minEdad == "" and $localidad == "") {
			$this->envioMasivo($mensaje, $encuesta);
			$res = 1; }
		else if ($maxEdad != "" and $minEdad != "" and $localidad != "") {
			$local = $this->em->getRepository('modeloBundle:ScdLocalidad')->findOneByNombrelocalidad($localidad);
			if (!$local->getId() > 0) {
				$res = 2;}
			if ($genero == "")
				$genero = 2;			
			$this->envioFiltrado($local, $minEdad, $maxEdad, $genero, $mensaje, $encuesta);
			$res = 1;}
		else if ($maxEdad != "" and $minEdad != "" and $localidad == "") {
			$localidades = $this->em->getRepository('modeloBundle:ScdLocalidad')->findAll();
			if ($genero == "")
				$genero = 2;			
			foreach ($localidades as $l){
			$this->envioFiltrado($l, $minEdad, $maxEdad, $genero, $mensaje, $encuesta);}
			$res = 1;}
		else if ($maxEdad == "" and $minEdad == "" and $localidad != "") {
			$local = $this->em->getRepository('modeloBundle:ScdLocalidad')->findOneByNombrelocalidad($localidad);
			if (!$local->getId() > 0) {
				$res = 2;}			
			if ($genero == "")
				$genero = 2;
			$this->envioFiltrado($local, 0, 99, $genero, $mensaje, $encuesta);
			$res = 1;}
		else if ($genero != "" and $maxEdad == "" and $minEdad == "" and $localidad == "") {
			$localidades = $this->em->getRepository('modeloBundle:ScdLocalidad')->findAll();		
			foreach ($localidades as $l){
			$this->envioFiltrado($l, 0, 99, $genero, $mensaje, $encuesta);}
			$res = 1;}
		else
			$res = 2;
	return $res;
 }
}
