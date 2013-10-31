<?php

namespace matilti\mensajeriaBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Yaml\Yaml;

class PublicacionMensaje
{ 
 private $em;

 public function __construct(EntityManager $entityManager)
 {
        $this->em = $entityManager;
 }
 
 function publicarTwitter($mensaje) {
	try {
	    $info = Yaml::parse(file_get_contents("./../app/config/redesSociales.yml"));
	} catch (ParseException $e) {
	    throw new \Exception("Unable to parse the YAML string: %s".$e->getMessage());
	}
	$consumerKey = $info['twitter']['consumer_key'];
	$consumerSecret = $info['twitter']['consumer_secret'];
	$userToken = $info['twitter']['user_token'];
	$userSecret = $info['twitter']['user_secret'];

	require_once('lib/tmhOAuth.php');
	$conexion = new \tmhOAuth(array(
					'consumer_key' => $consumerKey,
    					'consumer_secret' => $consumerSecret,
					'user_token' => $userToken,
					'user_secret' => $userSecret,
					'curl_ssl_verifypeer'   => false,
  					)); 


	if (strlen($mensaje) > 140){
		$mensaje = substr($mensaje,0,137);
		$mensaje = $mensaje.'...';
	}	
	return $conexion->request('POST', $conexion->url('1/statuses/update'), array('status' => $mensaje));
 }

  function publicarFacebook($mensaje) {

	try {
	    $info = Yaml::parse(file_get_contents("./../app/config/redesSociales.yml"));
	
	} 
	catch (ParseException $e) {
	    throw new \Exception("Unable to parse the YAML string: %s".$e->getMessage());
	}
	$appId = $info['facebook']['appId'];
	$secret = $info['facebook']['secret'];
	$userId = $info['facebook']['userId'];

	require_once('lib/facebook.php');	
	$facebook = new \Facebook(array(
 		'appId'  => $appId,
 		'secret' => $secret	));
	$attachment = array('message'=> $mensaje);

	$ruta = '/'.$userId.'/feed';
	return $facebook->api($ruta,'POST', $attachment);	
 }
}
