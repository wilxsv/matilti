<?php

namespace matilti\modeloBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;


class ScdUsuarioRepository extends EntityRepository
{
	/**
	 * Retorna usuarios mas activos en el sistema
	 */
	  public function masActivo(){
	   $limit = 10;
	   $sql = '
	       SELECT u.username, u.telefonousuario, u.id, u.salt FROM (
	        SELECT u.id, u.username, COUNT(*) as telefonousuario, SUM(u.cn) as salt FROM (
	         (SELECT u.id, u.username, 0 as cn FROM inbox i, scd_usuario u WHERE get_numero(i.sendernumber) = u.telefonousuario)
	         UNION ALL
	         (SELECT u.id, u.username, 1 as cn FROM sentitems s, scd_usuario u WHERE u.telefonousuario::TEXT LIKE \'%\'||s.destinationnumber)
	        ) as u GROUP BY 1, 2 ORDER BY 3 DESC LIMIT :limit
	       ) as u';
	   
	   $rsm = new ResultSetMapping;
	   $rsm->addEntityResult('modeloBundle:ScdUsuario', 'u');
       $rsm->addFieldResult('u', 'username', 'username');
       $rsm->addFieldResult('u', 'salt', 'salt');
       $rsm->addFieldResult('u', 'id', 'id');
       $rsm->addFieldResult('u', 'telefonousuario', 'telefonousuario');
	   
	   $qns = $this->getEntityManager()->createNativeQuery($sql, $rsm);
	   $qns->setParameter('limit', $limit);
	   
	   try { return $qns->getResult(); }
	   catch (\Doctrine\Orm\NoResultException $e) { $query = null; }
	  }

	/**
	 * Retorna usuarios que mas envian mensajes al sistema
	 */
	  public function masEnviado(){
	   $sql = 'SELECT i.id, u.username, count(*) as telefonousuario FROM inbox i, scd_usuario u WHERE get_numero(i.sendernumber) = u.telefonousuario GROUP BY 1, 2 ';
	   $rsm = new ResultSetMapping;
	   $rsm->addEntityResult('modeloBundle:ScdUsuario', 'u');
       $rsm->addFieldResult('u', 'id', 'id');
       $rsm->addFieldResult('u', 'telefonousuario', 'telefonousuario');
	   
	   $qns = $this->getEntityManager()->createNativeQuery($sql, $rsm);
	   
	   try { return $qns->getResult(); }
	   catch (\Doctrine\Orm\NoResultException $e) { $query = null; }
	  }

	/**
	 * Retorna usuarios que mas reciben mensajes del sistema
	 */
	  public function masRecibido(){
	   $limit = 10;
	   $sql = '
	       SELECT u.username, COUNT(*) as total FROM sentitems s, scd_usuario u WHERE u.telefonousuario::TEXT LIKE \'%\'||s.destinationnumber AND u.username IN (
	   SELECT u.username FROM (
	        (SELECT u.username FROM inbox i, scd_usuario u WHERE get_numero(i.sendernumber) = u.telefonousuario)
	        UNION ALL
	        (SELECT u.username FROM sentitems s, scd_usuario u WHERE u.telefonousuario::TEXT LIKE \'%\'||s.destinationnumber)
	       ) as u GROUP BY 1 ORDER BY 1 DESC LIMIT :limit) GROUP BY 1 ORDER BY 1 DESC';
	   
	   $rsm = new ResultSetMapping;
	   $rsm->addEntityResult('modeloBundle:ScdUsuario', 'u');
	   
	   $qns = $this->getEntityManager()->createNativeQuery($sql, $rsm);
	   $qns->setParameter('limit', $limit);
	   
	   try { return $qns->getResult(); }
	   catch (\Doctrine\Orm\NoResultException $e) { $query = null; }
	  }

	/**
	 * Retorna verdadero si un usuario esta habilitado para usar el web service
	 */
	  public function userWS($usuario, $firma){
	   if (isset($usuario) && isset($firma) ){
		$query = $this->getEntityManager()
		         ->createQuery("SELECT u.salt FROM modeloBundle:ScdUsuario u WHERE u.username=:usuario")
		         ->setParameter('usuario', $usuario)->getResult();
		if (!$query){ return FALSE; }
		else{
		 foreach ($query as $salt){
		  $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
		  $password = $encoder->encodePassword($firma, $salt['salt']);
		  $usr = $this->getEntityManager()
		         ->createQuery("
		         SELECT r.nombrerol
		         FROM modeloBundle:ScdUsuario u JOIN u.rol r
		         WHERE u.username=:usuario AND u.password=:password")
		         ->setParameters(array ( 'usuario' => $usuario, 'password' => $password))->getResult();
		  if ($usr) {
		   foreach ($usr as $valid){
			if ($valid['nombrerol'] == 'ROLE_WSERVICE') { return TRUE; }
		   }
		  }
		 }
		}
        return FALSE;
	   } 
	   
	return $query;/*
	   try { return $query->getResult(); }
	   catch (\Doctrine\Orm\NoResultException $e) { $query = null; }*/
	  }

    public function findAllActivos()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT u FROM modeloBundle:ScdUsuario u WHERE u.estado < 4')
            ->getResult();
    }


    public function edades(){
	   $sql = 'SELECT u.salt, COUNT(*) as id FROM(
	       SELECT 1 as id, (? - nacimientousuario)/365 as salt, (CASE sexousuario WHEN 1 THEN 1 ELSE 0 END) as m
	       FROM scd_usuario
	       ) as u GROUP BY salt, id';
	   
	   $rsm = new ResultSetMapping;
	   $rsm->addEntityResult('modeloBundle:ScdUsuario', 'u');
       $rsm->addFieldResult('u', 'salt', 'salt');
       $rsm->addFieldResult('u', 'id', 'id');
	   
	   $qns = $this->getEntityManager()->createNativeQuery($sql, $rsm);
	   $qns->setParameter(1, date('Y-m-d H:m:s'));
	   
	   try { return $qns->getResult(); }
	   catch (\Doctrine\Orm\NoResultException $e) { $query = null; }
    }


    public function findByFiltros($localidad, $genero)
    {
        if ($genero < 2){ 
		return $this->getEntityManager()
			->createQuery(
				'SELECT u FROM modeloBundle:ScdUsuario u WHERE u.estado < 4 
				AND u.localidad = :localidad AND u.sexousuario = :genero')
			->setParameters(array(
				'localidad' => $localidad->getId(),
				'genero' => $genero))
			->getResult();
	}
	else { 
		return $this->getEntityManager()
			->createQuery(
				'SELECT u FROM modeloBundle:ScdUsuario u WHERE u.estado < 4 
				AND u.localidad = :localidad')
			->setParameter('localidad', $localidad->getId())
			->getResult();
	}
    }
    
    
}
