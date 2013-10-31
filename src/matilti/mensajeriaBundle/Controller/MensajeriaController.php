<?php

namespace matilti\mensajeriaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use matilti\mensajeriaBundle\Form\Type\EnvioMensaje;
use matilti\mensajeriaBundle\Form\Type\ContestarMensaje;
use matilti\mensajeriaBundle\Form\Type\PublicacionMensaje;
use matilti\mensajeriaBundle\Form\Type\EnvioEncuesta;
use matilti\mensajeriaBundle\Form\Type\ConsultarEncuesta;

use matilti\modeloBundle\Entity\ScdEncuesta;

use Symfony\Component\Yaml\Yaml;

use MakerLabs\PagerBundle\Pager;
use MakerLabs\PagerBundle\Adapter\DoctrineOrmAdapter;

class MensajeriaController extends Controller
{
 public function indexAction() {
	return $this->render('mensajeriaBundle::default.html.twig'); }

 function listarEnviadosAction($page=1) {
	$request = Request::createFromGlobals();
  	if ($request->getMethod()=='GET')
		$page = $request->query->get('page');
  	$formEnviar = $this->createForm(new EnvioMensaje());
  	$em = $this->getDoctrine()->getEntityManager();
  	$mensajes = $em->getRepository('modeloBundle:ScdEnviado')->findAll();
	$entidad = 'ScdEnviado';
	return $this->render('mensajeriaBundle:Mensajeria:enviados.html.twig', array(
				'mensajes' => $mensajes,
				'formEnviar'   => $formEnviar->createView(),
				'pager' => $this->lista($page, $entidad), ));
 }

 function listarRecibidosAction($page=1) {
	$request = Request::createFromGlobals();
  	if ($request->getMethod()=='GET')
		$page = $request->query->get('page');
  	$formContestar = $this->createForm(new ContestarMensaje());
  	$em = $this->getDoctrine()->getEntityManager();
  	$mensajes = $em->getRepository('modeloBundle:ScdRecibido')->findAll();
	$entidad = 'ScdRecibido';
	return $this->render('mensajeriaBundle:Mensajeria:recibidos.html.twig', array(
				'mensajes' => $mensajes,
				'formContestar'=> $formContestar->createView(),
				'pager' => $this->lista($page, $entidad), )); }

 function listarEncuestasAction($page=1) {
	$request = Request::createFromGlobals();
  	if ($request->getMethod()=='GET')
		$page = $request->query->get('page');
  	$formEncuestar = $this->createForm(new EnvioEncuesta());
  	$em = $this->getDoctrine()->getEntityManager();
  	$mensajes = $em->getRepository('modeloBundle:ScdEncuesta')->findAll();
	$entidad = 'ScdEncuesta';
	return $this->render('mensajeriaBundle:Mensajeria:encuestas.html.twig', array(
				'mensajes' => $mensajes,
				'formEncuestar'=> $formEncuestar->createView(),
				'pager' => $this->lista($page, $entidad), )); }

  function listarConsultasAction() {
  	$formConsultar = $this->createForm(new ConsultarEncuesta());
	return $this->render('mensajeriaBundle:Mensajeria:resultados.html.twig', array(
				'formConsultar'=> $formConsultar->createView(), )); }

 function enviarMensajeAction(Request $request) {
		if ($this->getRequest()->isXmlHttpRequest()) {
			$resultado = 'Ha ocurrido un error, intente de nuevo';
			$form = $this->createForm(new EnvioMensaje());
			$form->bindRequest($request);
			$data = $form->getData();
			$mensaje = $data['mensaje'];
			$localidad = $data['localidad'];
			$minEdad = $data['minEdad'];
			$maxEdad = $data['maxEdad'];
			$masivo = $data['masivo'];
			$generoForm = $data['genero'];
			if ($form->isValid()) {
				$cantidad = 0;
				if ($masivo == 1) 
					$cantidad = $this->get('envio_mensajes')->envioMasivo($mensaje);
				else 
					$cantidad = $this->get('envio_mensajes')->envioFiltrado($localidad, $minEdad, $maxEdad, $generoForm, $mensaje);
				if ($cantidad > 0)
					$resultado = 'Mensaje enviado exitosamente';
				else 
					$resultado = 'No existen usuarios que cumplan las condiciones establecidas, gracias.';	}
			else 
				$resultado = 'Datos invalidos, intente de nuevo, gracias.';
		        return $this->render('mensajeriaBundle:Mensajeria:enviadosR.html.twig', 
					array('pager' => $this->lista($page=1, 'ScdEnviado')));}
		else
			throw new AccessDeniedException(); 

 }
 function contestarMensajeAction($id) {
	if ($this->getRequest()->isXmlHttpRequest()) {
	   	$em = $this->getDoctrine()->getEntityManager();
   		$recibido = $em->getRepository('modeloBundle:ScdRecibido')->find($id);
		if (!$recibido)
			throw $this->createNotFoundException('Unable to find ScdEnviado entity.'); 
		$resultado = 'Ha ocurrido un error, intente de nuevo';
		$form = $this->createForm(new ContestarMensaje());
		$form->bindRequest($this->getRequest());
		$data = $form->getData();
		$mensaje = $data['respuesta'];
		$numero = $recibido->getUsuario()->getTelefonousuario();
		$estado = $recibido->getUsuario()->getEstado()->getId();
		$respuestaId = $recibido->getId();	
		if ($form->isValid()) {
			if ($estado < 4) {
				$cantidad = $this->get('envio_mensajes')->enviarMensaje($mensaje, $numero, 0, $respuestaId);
				$resultado = 'Mensaje enviado exitosamente. '; }
			else
				$resultado = 'El usuario se encuentra deshabilitado.'; }
		else {
			$resultado = 'Datos invalidos, intente de nuevo, gracias.'; }
		return $this->render('mensajeriaBundle:Mensajeria:resultado.html.twig', array('resultado' => $resultado)); }
 	else
		throw new AccessDeniedException();  
 }
 function publicarMensajeAction($id) { 
	$ip = $this->get('request')->getClientIp();
	if ($this->getRequest()->isXmlHttpRequest()) {
	   	$em = $this->getDoctrine()->getEntityManager();
   		$mensaje = $em->getRepository('modeloBundle:ScdRecibido')->find($id);
		if (!$mensaje)
			throw $this->createNotFoundException('Unable to find ScdEnviado entity.');
		$mensaje = $mensaje->getMensajerecibido();	
		$mensaje = strstr($mensaje, " ");
		//$resultadoTwitter = $this->get('publicacion_mensajes')->publicarTwitter($mensaje);
		if ($resultadoTwitter == 200)
			$resultado = 'El mensaje fue posteado exitosamente en Twitter. ';
		else {
			$resultado = 'Ocurrio un error al postear en Twitter, probablemente sea un mensaje repetido.';	
			 throw new \Exception($resultado);}
		return $this->render('mensajeriaBundle:Mensajeria:resultado.html.twig', array('resultado' => $resultado));	
	}
	else
		throw new AccessDeniedException(); 	
 }
 function enviarEncuestaAction(Request $request) {
	$ip = $this->get('request')->getClientIp();
	if ($this->getRequest()->isXmlHttpRequest()) {
		$resultado = 'Ha ocurrido un error, intente de nuevo.';
		$form = $this->createForm(new EnvioEncuesta());
		$form->bindRequest($request);
		$data = $form->getData();	
		$pregunta = $data['pregunta'];
		$respuestas = $data['respuestas'];
		$localidad = $data['localidad'];
		$minEdad = $data['minEdad'];
		$maxEdad = $data['maxEdad'];
		$generoForm = $data['genero'];
		if ($form->isValid()) 
			$resultado = $this->get('envio_mensajes')->enviarEncuesta($pregunta, $respuestas, $localidad, $minEdad, $maxEdad, $generoForm);
		else 
			$resultado = 'Datos invalidos, intente de nuevo, gracias.';
		return $this->render('mensajeriaBundle:Mensajeria:encuestasR.html.twig', 
					array('pager' => $this->lista($page=1, 'ScdEncuesta'))); }
	else
		throw new AccessDeniedException(); 

 }
 function consultarEncuestaAction(Request $request) {
	$ip = $this->get('request')->getClientIp();
	if ($this->getRequest()->isXmlHttpRequest()) {
		$resultado = 'Ha ocurrido un error, intente de nuevo.';
		$otras = 0;
		$pos = 0;
		$cantidadRespuestas = array();
		$porcentajes = array();
		$form = $this->createForm(new ConsultarEncuesta());
		$form->bindRequest($request);
		$data = $form->getData();
		$encuesta = $data['encuesta'];
		$respuestas = explode(',', strtoupper($encuesta->getRespuestasencuesta()));
		$mensajes = $this->getDoctrine()->getEntityManager()
				->getRepository('modeloBundle:ScdRecibido')->mensajesEncuesta($encuesta);
		$total = count($mensajes);
		foreach ($mensajes as $mensaje) {
			$texto = trim(strstr(strtoupper($mensaje->getMensajerecibido()), " "));
			$posicion = 0;
			$encontrada = false;
			foreach ($respuestas as $respuesta){
				$respuesta = trim($respuesta);
				if (!array_key_exists($posicion, $cantidadRespuestas))
					array_push($cantidadRespuestas, 0);
				if ($texto == $respuesta) {
					$cantidadRespuestas[$posicion] += 1;
					$encontrada = true; }
				$posicion += 1;		}
			if ($encontrada == false){
				$otras += 1; } }
		foreach ($respuestas as $respuesta) {
			$porcentajes[$respuesta] = round(100 * $cantidadRespuestas[$pos] / $total, 2);
			$pos++;	}
		return $this->render('mensajeriaBundle:Mensajeria:consultasR.html.twig', 
					array('porcentajesRespuestas' => $porcentajes,
					      'respuestas' => $respuestas, )); }
	else 
		throw new AccessDeniedException();
	
 }
 private function lista($page, $entidad){
  $em = $this->getDoctrine()->getEntityManager();
  $qb = $em->getRepository('modeloBundle:'.$entidad)->createQueryBuilder('m')->orderBy('m.id', 'DESC');
  $adapter = new DoctrineOrmAdapter($qb);
  $pager = new Pager($adapter, array('page' => $page, 'limit' => 10));
  return $pager;
 }

 function wsAction($xml){
	if ($this->getRequest()->isXmlHttpRequest()) {
		$res = $this->get('envio_mensajes')->webService($xml);
		return $this->render('mensajeriaBundle:Mensajeria:resultado.xml.twig', array('resultado' => $res->asXML()));
	}	
	else
		throw new AccessDeniedException();
 }
}
