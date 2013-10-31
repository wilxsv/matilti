<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\ScdEstado
 */
class ScdEstado
{
    /**
     * @var bigint $id
     */
    private $id;

    /**
     * @var string $nombreestado
     */
    private $nombreestado;

    /**
     * @var text $detalleestado
     */
    private $detalleestado;


    /**
     * Get id
     *
     * @return bigint 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombreestado
     *
     * @param string $nombreestado
     */
    public function setNombreestado($nombreestado)
    {
        $this->nombreestado = $nombreestado;
    }

    /**
     * Get nombreestado
     *
     * @return string 
     */
    public function getNombreestado()
    {
        return $this->nombreestado;
    }

    /**
     * Set detalleestado
     *
     * @param text $detalleestado
     */
    public function setDetalleestado($detalleestado)
    {
        $this->detalleestado = $detalleestado;
    }

    /**
     * Get detalleestado
     *
     * @return text 
     */
    public function getDetalleestado()
    {
        return $this->detalleestado;
    }

    public function __toString(){
        return $this->getNombreestado();
    }
}