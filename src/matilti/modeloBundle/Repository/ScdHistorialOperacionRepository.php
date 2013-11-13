<?php

namespace matilti\modeloBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class ScdHistorialOperacionRepository extends EntityRepository
{
    public function findAllOrderByDate()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT h FROM modeloBundle:ScdHistorialOperacion h ORDER BY h.fechahisoperacion DESC')
            ->getResult();
    }
    
   /**
    * Consulta retorna las ultimas 5 operaciones
   */
	  public function last5Oper(){
	   $query = $this->getEntityManager()
	         ->createQuery("
	           SELECT o
	           FROM modeloBundle:ScdHistorialOperacion o
	           ORDER BY o.fechahisoperacion DESC
	           ")->setMaxResults(7);
	   try { return $query->getResult(); }
	   catch (\Doctrine\Orm\NoResultException $e) { $query = null; }
	  }

   /**
    * Consulta retorna las operaciones fallidas
   */
	  public function fallidas(){
	   $sql = 'SELECT CAST(o.id AS text)||o.mensajeotrosms||CAST(o.id AS text) AS id FROM scd_usuario u, scd_otros_sms o WHERE get_numero(o.numerootrosms) = u.telefonousuario';//count (u.id)
	   $rsm = new ResultSetMapping;
	   $rsm->addEntityResult('modeloBundle:ScdUsuario', 'u');
       $rsm->addFieldResult('u', 'id', 'id');
	   
	   $qns = $this->getEntityManager()->createNativeQuery($sql, $rsm);
	   
	   try { return $qns->getResult(); }
	   catch (\Doctrine\Orm\NoResultException $e) { $query = null; }
	  }

   /**
    * Consulta retorna las operaciones fallidas
   */
	  public function fallida(){
   $query = $this->getEntityManager()
            	->createQuery('
            	SELECT o.inboxId
                FROM modeloBundle:ScdUsuario u, modeloBundle:ScdOtrosSms o
                WHERE u.telefonousuario = get_numero(o.numerootrosms)
                GROUP BY o.inboxId')
                ->getResult();
   try { return $query; }
   catch (\Doctrine\Orm\NoResultException $e) { $query = null; }
	  }
  
}
