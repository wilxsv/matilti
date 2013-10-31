<?php

namespace matilti\modeloBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ScdEncuestaRepository extends EntityRepository
{
    public function findAllOrderByDate()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT e FROM modeloBundle:ScdEncuesta e ORDER BY e.fechahorainicio DESC')
            ->getResult();
    }

  
}
