<?php
namespace matilti\reporteriaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ReporteriaController extends Controller
{
 public function indexAction(){
	return $this->render('reporteriaBundle::default.html.twig'); 
 }

 public function defensoraAction(){
		$em = $this->getDoctrine()->getEntityManager();
		$ultimas = $em->getRepository('modeloBundle:ScdHistorialOperacion')->last5Oper();
		$general = $this->generarGeneral();
		
		$d_localidad = $em->getRepository('modeloBundle:ScdDenuncia')->findAllByLocalidad();
		$d_entidad =  $em->getRepository('modeloBundle:ScdDenuncia')->getDenunciasPorEntidad();
         
	return $this->render('reporteriaBundle::defensora.html.twig',
				array('ultimas' => $ultimas, 'titulo' => $general[0], 'respuestas' => $general[1], 'valores' => $general[2], 'd_localidad' => $d_localidad, 'd_entidad' => $d_entidad)); 
 }

 public function reportesAction(){
	return $this->render('reporteriaBundle:Reporteria:resultado.html.twig');
 }

 public function lastReportesAction() {

	//========Reporte General=================
	$general = $this->generarGeneral();
	
	//========Reporte Encuesta=================
	$encuestas = $this->generarEncuestas();

	//=======Reporte Historial operaciones===========
	$historial = $this->generarHistorial();
	
	//=======Denuncias===========
	$users = $this->getDoctrine()->getRepository('modeloBundle:ScdUsuario')->masActivo();
	$tituloUser = array ('Enviado' => 'Enviado', 'Recibido' => 'Recibido', 'Total' => 'Total');

	//=======Reporte Usuarios por localidad===========
	$localidad = $this->generarLocalidades(1);		
	
	//=======Reporte Usuarios por genero===========
	$genero = $this->generarGeneros();

	//=======Reporte Usuarios por edad===========
	$edad = $this->generarEdades(1);

	return $this->render('reporteriaBundle:Reporteria:resultado.html.twig', array(
				'titulo' => $general[0], 'respuestas' => $general[1], 'valores' => $general[2],
				'datosE' => $encuestas[0], 'valoresE' => $encuestas[1], 'tituloE' => $encuestas[2], 'encuestasE' => $encuestas[3], 'recibidosE' => $encuestas[4],
				'tituloH' => $historial[0],'operacionesH' => $historial[1],
				
				'tituloD' => 'Denuncias recibidas', 'denuncias' => $this->getDoctrine()->getRepository('modeloBundle:ScdDenuncia')->getDenunciasPorEntidad(), 'tituloUser' => $tituloUser,
				
				'masActivo' => $users, 'dato' => $edad,
				'valoresL' => $localidad[0], 'tituloL' => $localidad[1], 'localidadesL' => $localidad[2],
				'tituloG' => $genero[0], 'generoG' => $genero[1], 'valoresG' => $genero[2],
				'tituloA' => $edad[0],'edadesA' => $edad[0],'valoresA' => $edad[0], )); 
 }
 private function generarGeneral() {
	$titulo = 'Trafico General';
	$dato = 'Enviados';
	$respuestas[] = $dato;
	$valores[$dato] = count($this->getDoctrine()->getRepository('modeloBundle:Sentitems')->findAll());
	$dato = 'Recibidos';
	$respuestas[] = $dato;
	$valores[$dato] = count($this->getDoctrine()->getRepository('modeloBundle:Inbox')->findAll());
	$dato = 'Otros';
	$respuestas[] = $dato;
	$valores[$dato] = count($this->getDoctrine()->getRepository('modeloBundle:ScdOtrosSms')->findAll());
	$dato = 'Fallidos';
	$respuestas[] = $dato;
	$valores[$dato] = count($this->getDoctrine()->getRepository('modeloBundle:ScdHistorialOperacion')->fallidas());
	$dato = 'total_denuncias';
	$respuestas[] = $dato;
	$valores[$dato] = count($this->getDoctrine()->getRepository('modeloBundle:ScdDenuncia')->findAll());
	$gen[] = $titulo;
	$gen[] = $respuestas;
	$gen[] = $valores;
	return $gen;
 }
 private function generarEncuestas() {
	$tituloE = 'Ultimas 5 Encuestas';
	$encuestasE = $this->getDoctrine()->getRepository('modeloBundle:ScdEncuesta')->findAllOrderByDate();	
	$cantidad = count($encuestasE);
	if ($cantidad>5) {
		for ($i=$cantidad; $i > 5; $i--) {
			array_pop($encuestasE);
			$cantidad = count($encuestasE);}}
	$datosE = array();
	$valoresE = array();
	$recibidosE = array();
	foreach ($encuestasE as $encuesta){
		$otras = 0;
		$pos = 0;
		$cantidadRespuestasE = array();
		$porcentajesE = array();
		$respuestasE = array();
		$mensajesE = array();
		$respuestasE = explode(',', strtoupper($encuesta->getRespuestasencuesta()));
		$mensajesE = $this->getDoctrine()->getEntityManager()
				->getRepository('modeloBundle:ScdRecibido')->mensajesEncuesta($encuesta);
		$total = count($mensajesE);
		$recibidosE[$encuesta->getId()] = $total;
		if ($total == 0) {
			$posicion = 0;
			foreach ($respuestasE as $respuesta){
				if (!array_key_exists($posicion, $cantidadRespuestasE))
					array_push($cantidadRespuestasE, 0);
				$cantidadRespuestasE[$posicion] = 0;
				$posicion++; } }
		foreach ($mensajesE as $mensaje) {
			$texto = trim(strstr(strtoupper($mensaje->getMensajerecibido()), " "));
			$posicion = 0;
			$encontrada = false;
			foreach ($respuestasE as $respuesta){
				$respuesta = trim($respuesta);
				if (!array_key_exists($posicion, $cantidadRespuestasE))
					array_push($cantidadRespuestasE, 0);
				if ($texto == $respuesta) {
					$cantidadRespuestasE[$posicion] += 1;
					$encontrada = true; }
				$posicion += 1;		}
			if ($encontrada == false){
				$otras += 1; } }
		$valoresE[$encuesta->getId()] = $cantidadRespuestasE;
		$datosE[$encuesta->getId()] = $respuestasE;	}
	$enc[] = $datosE;
	$enc[] = $valoresE;
	$enc[] = $tituloE;
	$enc[] = $encuestasE;
	$enc[] = $recibidosE;
	return $enc;
 }
 private function generarHistorial() {
	$tituloH = 'Ultimas operaciones';
	$datosH = $this->getDoctrine()->getRepository('modeloBundle:ScdHistorialOperacion')->findAllOrderByDate();		
	$cantidad = count($datosH);
	if ($cantidad>10) {
		for ($i=$cantidad; $i > 10; $i--) {
			array_pop($datosH);
			$cantidad = count($datosH); }}
	$hist[] = $tituloH;
	$hist[] = $datosH;
	return $hist;
 }
 public function generarDenuncias($users) {
	$todas = $this->getDoctrine()->getRepository('modeloBundle:ScdUsuario')->masEnviado();
	$nodos = array();
	foreach ($users as $dato){
	 foreach ($todas as $valor){
	  if ($dato->getUsername() == $valor->getUsername()) {$nodos[$dato->getUsername()] = $valor->getTelefonousuario();}
	  if ($nodos[$dato->getUsername()] == 0) {$nodos[$dato->getUsername()] = $dato->getTelefonousuario();}
	 }
	}
	return $nodos;
 }
 private function generarLocalidades($mayores) {
	$topL = $mayores;	
	$tituloL = 'Usuarios por localidad';
	$localidadesIni =  $this->getDoctrine()->getRepository('modeloBundle:ScdLocalidad')->findAll();
	foreach ($localidadesIni as $localidad) {
		$datoL = $localidad->getId();
		$valoresL[$datoL] = count($this->getDoctrine()->getRepository('modeloBundle:ScdUsuario')->findByLocalidad($datoL));	
		if ($valoresL[$datoL] == 0) 
			unset($valoresL[$datoL]);
		else
			$localidadesL[] = $localidad; }
	$cantidadL = count($localidadesL);
	if ($cantidadL>5) {
		if ($topL == 0)
			asort($valoresL);
		else
			arsort($valoresL);
		for ($i=$cantidadL; $i > 5; $i--) 
				array_pop($valoresL);
		foreach ($localidadesL as $localidad) {
			if (isset($valoresL[$localidad->getId()]))	
			$localidadesSelL[] = $localidad;} }
	else
		$localidadesSelL = $localidadesL;
	$loc[] = $valoresL;
	$loc[] = $tituloL;
	$loc[] = $localidadesSelL;
	return $loc;
 }
 private function generarGeneros() {
	$tituloG = 'Usuarios por género';
	$datoG = 'Femenino';
	$generoG[] = $datoG;
	$valoresG[$datoG] = count($this->getDoctrine()->getRepository('modeloBundle:ScdUsuario')->findBySexousuario('0'));
	$datoG = 'Masculino';
	$generoG[] = $datoG;
	$valoresG[$datoG] = count($this->getDoctrine()->getRepository('modeloBundle:ScdUsuario')->findBySexousuario('1'));
	$gen[] = $tituloG;
	$gen[] = $generoG;
	$gen[] = $valoresG;
	return $gen;
 }
 public function generarEdades($mayores){
	$topA = $mayores;	
	$tituloA = 'Usuarios por edad';
	$edadesA = array();
	$edadesSelA = array();
	$cantidadesA = array();
	$ahora = new \DateTime();	
	$usuarios = $this->getDoctrine()->getRepository('modeloBundle:ScdUsuario')->edades();
	foreach ($usuarios as $user) {
		$edad = $user->getSalt();
		$existe = 0;		   // /calculo de edad
		foreach($edadesA as $e){
			if ($e == $edad)
				$existe +=1; }
		if ($existe == 0)
			$edadesA[] = $edad; }
	foreach ($usuarios as $user) {
		$fechanac = new \DateTime();  //calculo de edad			
		$edad = $ahora->diff($fechanac);
		$edad = (integer)$edad->y;
		foreach($edadesA as $e){
			if ($e == $edad) {
				if (isset($cantidadesA[$e])) 
					$cantidadesA[$e] += 1;
				else
					$cantidadesA[$e] = 1; } } }
	$cantidadA = count($cantidadesA);
	if ($cantidadA > 5) {
		if ($topA == 0)
			asort($cantidadesA);
		else
			arsort($cantidadesA);
	
		for ($i=$cantidadA; $i > 5; $i--){
			array_pop($cantidadesA);}

		foreach ($edadesA as $e) {
			if (isset($cantidadesA[$e]))	
				$edadesSelA[] = $e;} }
	else
		$edadesSelA = $edadesA;
	$ed[] = $tituloA;
	$ed[] = $edadesSelA;
	$ed[] = $cantidadesA;
	return $ed;
 }
}
