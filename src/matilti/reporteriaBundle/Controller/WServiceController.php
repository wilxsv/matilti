<?php

namespace matilti\reporteriaBundle\Controller;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;
use matilti\modeloBundle\Entity\ScdDenuncia;


class WServiceController extends ContainerAware{
    /**
     * @Soap\Method("hello")
     * @Soap\Param("name", phpType = "string")
     * @Soap\Result(phpType = "string")
     */

    public function helloAction($name)
    {
        return $this->container->get('besimple.soap.response')->setReturnValue(sprintf('Unimplemented method [%s]', $phase));
    }

    /**
     * @Soap\Method("getPhase")
     * @Soap\Param("phase", phpType = "string")
     * @Soap\Result(phpType = "string")
     */

    public function getPhaseAction($phase)
    {
        return $this->container->get('besimple.soap.response')->setReturnValue(sprintf('Unimplemented method [%s]', $phase));
    }

    /**
     * @Soap\Method("getComplaint")
     * @Soap\Param("complaint", phpType = "string")
     * @Soap\Result(phpType = "string")
     */

    public function getComplaintAction($complaint)
    {
		if ($this->validateUser($complaint)){
			  return $this->container->get('besimple.soap.response')->setReturnValue(sprintf($this->getComplaint($complaint)));
			} else {
		      throw new \SoapFault('USER_NOT_FOUND', sprintf('The user can not be found'));
			}
    }

    /**
     * @Soap\Method("getHistoryComplaint")
     * @Soap\Param("query", phpType = "string")
     * @Soap\Result(phpType = "string")
     */

    public function getHistoryComplaintAction($query)
    {
		if ($this->validateUser($query)){
			  return $this->container->get('besimple.soap.response')->setReturnValue(sprintf($this->getHistoryComplaint($query)));
			} else {
		      throw new \SoapFault('USER_NOT_FOUND', sprintf('The user can not be found'));
			}//return $this->container->get('besimple.soap.response')->setReturnValue(sprintf('Unimplemented method [%s]', $query));
    }

    /**
     * @Soap\Method("setPoll")
     * @Soap\Param("query", phpType = "string")
     * @Soap\Result(phpType = "string")
     */

    public function setPollAction($query)
    {
        return $this->container->get('besimple.soap.response')->setReturnValue(sprintf('Unimplemented method [%s]', $query));
    }

    /**
     * @Soap\Method("setQuestion")
     * @Soap\Param("query", phpType = "string")
     * @Soap\Result(phpType = "string")
     */

    public function setQuestionAction($query)
    {
        return $this->container->get('besimple.soap.response')->setReturnValue(sprintf('Unimplemented method [%s]', $query));
    }

    /**
     * @Soap\Method("setResponse")
     * @Soap\Param("response", phpType = "string")
     * @Soap\Result(phpType = "string")
     */

    public function setResponseAction($response)
    {
		if ($this->validateUser($response)){
			  return $this->container->get('besimple.soap.response')->setReturnValue(sprintf($this->setResponse($response)));
			} else {
		      throw new \SoapFault('USER_NOT_FOUND', sprintf('The user can not be found'));
			}//return $this->container->get('besimple.soap.response')->setReturnValue(sprintf('Unimplemented method [%s]', $response));
    }
    
    private function validateUser($data){
	 $xml = simplexml_load_string($data);
	 $result = $xml->xpath('/matilti/credenciales/usuario');
	 $user = $result[0];
	 $result = $xml->xpath('/matilti/credenciales/firma');
	 $firma = $result[0];
	 
	 return $this->container->get('Doctrine')->getRepository('modeloBundle:ScdUsuario')->userWS($user, $firma);
	}
	
	private function getComplaint($data){
	 $xml = simplexml_load_string($data);
	 $result = $xml->xpath('/matilti/credenciales/usuario');
	 $user = $result[0];
	 $result = $xml->xpath('/matilti/credenciales/usuario');
	 $firma = $result[0];
	 $result = $xml->xpath('/matilti/consulta/fechainicial');
	 $inicio = $result[0];
	 $result = $xml->xpath('/matilti/consulta/fechafinal');
	 $fin = $result[0];
	 
	 //return $user.$inicio.$fin;
	 return $this->container->get('Doctrine')->getRepository('modeloBundle:ScdDenuncia')->findAllByEntidad($user, $inicio, $fin);
	}
	
	private function getHistoryComplaint($data){
	 $xml = simplexml_load_string($data);
	 $result = $xml->xpath('/matilti/id');
	 //$id = $result[0];
	 return $this->container->get('Doctrine')->getRepository('modeloBundle:ScdDenuncia')->findAllById($result[0]);
	}
	
	private function setResponse($data){
	 $xml = simplexml_load_string($data);
	 $result = $xml->xpath('/matilti/credenciales/usuario');
	 $user = $result[0];
	 $result = $xml->xpath('/matilti/id');
	 $id = $result[0];
	 $result = $xml->xpath('/matilti/mensaje');
	 $msg = $result[0];
	 
	 return $this->container->get('Doctrine')->getRepository('modeloBundle:ScdDenuncia')->setRespuesta($user, $id, $msg);
	}
}
