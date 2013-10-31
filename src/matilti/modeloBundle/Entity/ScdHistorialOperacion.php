<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\ScdHistorialOperacion
 */
class ScdHistorialOperacion
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var datetime $fechahisoperacion
     */
    private $fechahisoperacion;

    /**
     * @var string $detallehisoperacion
     */
    private $detallehisoperacion;

    /**
     * @var string $ipoperacion
     */
    private $ipoperacion;

    /**
     * @var matilti\modeloBundle\Entity\ScdUsuario
     */
    private $usuario;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechahisoperacion
     *
     * @param datetime $fechahisoperacion
     */
    public function setFechahisoperacion($fechahisoperacion)
    {
        $this->fechahisoperacion = $fechahisoperacion;
    }

    /**
     * Get fechahisoperacion
     *
     * @return datetime 
     */
    public function getFechahisoperacion()
    {
        return $this->fechahisoperacion;
    }

    /**
     * Set detallehisoperacion
     *
     * @param string $detallehisoperacion
     */
    public function setDetallehisoperacion($detallehisoperacion)
    {
        $this->detallehisoperacion = $detallehisoperacion;
    }

    /**
     * Get detallehisoperacion
     *
     * @return string 
     */
    public function getDetallehisoperacion()
    {
        return $this->detallehisoperacion;
    }

    /**
     * Set ipoperacion
     *
     * @param string $ipoperacion
     */
    public function setIpoperacion($ipoperacion)
    {
        $this->ipoperacion = $ipoperacion;
    }

    /**
     * Get ipoperacion
     *
     * @return string 
     */
    public function getIpoperacion()
    {
        return $this->ipoperacion;
    }

    /**
     * Set usuario
     *
     * @param matilti\modeloBundle\Entity\ScdUsuario $usuario
     */
    public function setUsuario(\matilti\modeloBundle\Entity\ScdUsuario $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Get usuario
     *
     * @return matilti\modeloBundle\Entity\ScdUsuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}