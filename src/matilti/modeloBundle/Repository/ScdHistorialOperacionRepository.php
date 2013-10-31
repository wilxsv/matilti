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


  
}
