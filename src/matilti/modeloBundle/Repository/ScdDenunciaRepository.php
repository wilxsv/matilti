<?php

namespace matilti\modeloBundle\Repository;

use Doctrine\ORM\EntityRepository;
use matilti\modeloBundle\Entity\ScdDenuncia;
use matilti\modeloBundle\Entity\ScdEnviado;

class ScdDenunciaRepository extends EntityRepository{ 
 /**
  * Retorna el total de denuncias por entidad.
  */
  public function getDenunciasPorEntidad(){
   $query = $this->getEntityManager()
            	->createQuery('SELECT e.nombreentidad, e.latentidad, e.lonentidad, COUNT(e.lonentidad) as total, AVG(e.latentidad) as latitud, AVG(e.lonentidad) as longitud
                    FROM modeloBundle:ScdDenuncia d JOIN d.entidad e
                    GROUP BY e.nombreentidad, e.latentidad, e.lonentidad')
                ->getResult();
   try { return $query; }
   catch (\Doctrine\Orm\NoResultException $e) { $query = null; }
  }
	
 /**
  * Retorna un xml con los mensajes de una denuncia.
  */
 public function setRespuesta($user, $id, $mensaje){
  if (isset($id) && isset($user)){
   $query = $this->getEntityManager()
          ->createQuery("SELECT u.id as id, e.id as entidad
                         FROM modeloBundle:ScdUsuario u JOIN u.entidad e, modeloBundle:ScdDenuncia d
                         WHERE u.username=:user AND e.id=d.entidad AND d.id=:id")
          ->setParameters(array('user' => $user, 'id' => $id))->getResult();
   if (!$query){
	return '<matilti><trackid>Denuncia no encontrada</trackid></matilti>';
   } else {//
      $em = $this->getEntityManager();
      $v_entidad = $this->getEntityManager()->getRepository('modeloBundle:ScdEntidad')->find($query[0]['entidad']);
      $v_usuario = $this->getEntityManager()->getRepository('modeloBundle:ScdUsuario')->find($query[0]['id']);
      $v_denuncia = $this->getEntityManager()->getRepository('modeloBundle:ScdDenuncia')->find($id);
      
      $entity = new ScdDenuncia();
      $entity->setMensajedenuncia($mensaje);
      $entity->setFechahorainicio(new \DateTime('now'));
      $entity->setDenunciaactiva(1);
      $entity->setEntidad($v_entidad);
      $entity->setUsuario($v_usuario);
      $entity->setDenuncia($v_denuncia);
      $em->persist($entity);
      $em->flush();
      
      $entity = new ScdEnviado();
      $entity->setMensajeenviado($mensaje);
      $entity->setfechahoraenviado(new \DateTime('now'));
      $entity->setUsuario($v_usuario);
      $em->persist($entity);
      $em->flush();
      return '<matilti><trackid>Respuesta enviada</trackid></matilti>';
    }
  } else { return "<matilti><trackid>Datos recibidos incompletos</trackid></matilti>"; }
 }

 /**
  * Retorna un xml con los nodos de todas las entidades de acuerdo a la entidad del usuario que consulta el ws.
  */
 public function findAllByEntidad($usuario, $inicio, $fin){
  if (isset($usuario) && isset($inicio) && isset($fin) ){
   $query = $this->getEntityManager()
          ->createQuery("SELECT e.nombreentidad FROM modeloBundle:ScdUsuario u JOIN u.entidad e WHERE u.username=:usuario")
	  ->setParameter('usuario', $usuario)->getResult();
   if (!$query){
	return '<matilti><trackid>Entidad no asociada a usuario</trackid></matilti>';
   } else {//
      $datos = '<matilti>';
      $nodos = '';
      foreach ($query as $entidad){//'.$nodo['telefonousuario'].'
       $query2 = $this->getEntityManager()
          ->createQuery("SELECT d.mensajedenuncia, d.id, u.telefonousuario, d.fechahorainicio
                         FROM modeloBundle:ScdDenuncia d JOIN d.usuario u,
                             modeloBundle:ScdEntidad e
                         WHERE e.nombreentidad=:entidad AND d.entidad=e.id AND d.fechahorainicio>=:inicio AND d.fechahorainicio<=:fin")
	  ->setParameters(array('entidad' => $entidad['nombreentidad'], 'inicio' => $inicio, 'fin' => $fin))->getResult();
       foreach ($query2 as $nodo){ $nodos.='<mensajes><telefono></telefono><fecha>'.$nodo['fechahorainicio'].'</fecha><mensaje>'.$nodo['mensajedenuncia'].'</mensaje><id>'.$nodo['id'].'</id></mensajes>'; }
      }
      return $datos.$nodos.'</matilti>';
	  return '<matilti><trackid>TODOS LOS DATOS</trackid></matilti>';
    }
  } else { return "<matilti><trackid>Datos recibidos incompletos</trackid></matilti>"; }
 }
 
 /**
  * Retorna un xml con los mensajes de una denuncia.
  */
 public function findAllById($id){
  if (isset($id)){
   $query = $this->getEntityManager()
          ->createQuery("SELECT d.mensajedenuncia, d.id, u.telefonousuario, d.fechahorainicio
                         FROM modeloBundle:ScdDenuncia d JOIN d.usuario u
                         WHERE d.id=:id OR d.denuncia=:id ORDER BY d.id, d.fechahorainicio")
	  ->setParameter('id', $id)->getResult();
   if (!$query){
	return '<matilti><trackid>Denuncia no encontrada</trackid></matilti>';
   } else {//
      $datos = '<matilti>';
      $nodos = '';
      foreach ($query as $nodo){//'.$nodo['telefonousuario'].'
       $nodos.='<mensajes><telefono></telefono><fecha>'.$nodo['fechahorainicio'].'</fecha><mensaje>'.$nodo['mensajedenuncia'].'</mensaje><id>'.$nodo['id'].'</id></mensajes>'; 
      }
      return $datos.$nodos.'</matilti>';
    }
  } else { return "<matilti><trackid>Datos recibidos incompletos</trackid></matilti>"; }
 }

    public function denunciasFiltradas($fechainicial, $fechafinal, $reglaplicada) 
    {
	$entidad = $this->getEntityManager()->getRepository('modeloBundle:ScdEntidad')->findOneByNombreentidad($reglaplicada);
	
	$mensajes = $this->getEntityManager()
            		->createQuery('SELECT d FROM modeloBundle:ScdDenuncia d WHERE d.entidad = :entidad
				       AND d.fechahorainicio > :hInicio AND d.fechahorainicio < :hFin')
			->setParameters(array(
				'hInicio' => $fechainicial,
				'hFin' => $fechafinal,
				'entidad' => $entidad))
           		->getResult();
	return $mensajes;
    }
}
