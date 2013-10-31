<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\ScdEnviado
 */
class ScdEnviado
{
    /**
     * @var bigint $id
     */
    private $id;

    /**
     * @var string $mensajeenviado
     */
    private $mensajeenviado;

    /**
     * @var datetime $fechahoraenviado
     */
    private $fechahoraenviado;

    /**
     * @var matilti\modeloBundle\Entity\ScdEncuesta
     */
    private $encuesta;

    /**
     * @var matilti\modeloBundle\Entity\ScdRecibido
     */
    private $respuesta;

    /**
     * @var matilti\modeloBundle\Entity\ScdUsuario
     */
    private $usuario;


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
     * Set mensajeenviado
     *
     * @param string $mensajeenviado
     */
    public function setMensajeenviado($mensajeenviado)
    {
        $this->mensajeenviado = $mensajeenviado;
    }

    /**
     * Get mensajeenviado
     *
     * @return string 
     */
    public function getMensajeenviado()
    {
        return $this->mensajeenviado;
    }

    /**
     * Set fechahoraenviado
     *
     * @param datetime $fechahoraenviado
     */
    public function setFechahoraenviado($fechahoraenviado)
    {
        $this->fechahoraenviado = $fechahoraenviado;
    }

    /**
     * Get fechahoraenviado
     *
     * @return datetime 
     */
    public function getFechahoraenviado()
    {
        return $this->fechahoraenviado;
    }

    /**
     * Set encuesta
     *
     * @param matilti\modeloBundle\Entity\ScdEncuesta $encuesta
     */
    public function setEncuesta(\matilti\modeloBundle\Entity\ScdEncuesta $encuesta)
    {
        $this->encuesta = $encuesta;
    }

    /**
     * Get encuesta
     *
     * @return matilti\modeloBundle\Entity\ScdEncuesta 
     */
    public function getEncuesta()
    {
        return $this->encuesta;
    }

    /**
     * Set respuesta
     *
     * @param matilti\modeloBundle\Entity\ScdRecibido $respuesta
     */
    public function setRespuesta(\matilti\modeloBundle\Entity\ScdRecibido $respuesta)
    {
        $this->respuesta = $respuesta;
    }

    /**
     * Get respuesta
     *
     * @return matilti\modeloBundle\Entity\ScdRecibido 
     */
    public function getRespuesta()
    {
        return $this->respuesta;
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