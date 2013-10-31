<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\ScdEncuesta
 */
class ScdEncuesta
{
    /**
     * @var bigint $id
     */
    private $id;

    /**
     * @var string $mensajeencuesta
     */
    private $mensajeencuesta;

    /**
     * @var string $respuestasencuesta
     */
    private $respuestasencuesta;

    /**
     * @var datetime $fechahorainicio
     */
    private $fechahorainicio;

    /**
     * @var datetime $fechahorafin
     */
    private $fechahorafin;

    /**
     * @var decimal $encuestaactiva
     */
    private $encuestaactiva;


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
     * Set mensajeencuesta
     *
     * @param string $mensajeencuesta
     */
    public function setMensajeencuesta($mensajeencuesta)
    {
        $this->mensajeencuesta = $mensajeencuesta;
    }

    /**
     * Get mensajeencuesta
     *
     * @return string 
     */
    public function getMensajeencuesta()
    {
        return $this->mensajeencuesta;
    }

    /**
     * Set respuestasencuesta
     *
     * @param string $respuestasencuesta
     */
    public function setRespuestasencuesta($respuestasencuesta)
    {
        $this->respuestasencuesta = $respuestasencuesta;
    }

    /**
     * Get respuestasencuesta
     *
     * @return string 
     */
    public function getRespuestasencuesta()
    {
        return $this->respuestasencuesta;
    }

    /**
     * Set fechahorainicio
     *
     * @param datetime $fechahorainicio
     */
    public function setFechahorainicio($fechahorainicio)
    {
        $this->fechahorainicio = $fechahorainicio;
    }

    /**
     * Get fechahorainicio
     *
     * @return datetime 
     */
    public function getFechahorainicio()
    {
        return $this->fechahorainicio;
    }

    /**
     * Set fechahorafin
     *
     * @param datetime $fechahorafin
     */
    public function setFechahorafin($fechahorafin)
    {
        $this->fechahorafin = $fechahorafin;
    }

    /**
     * Get fechahorafin
     *
     * @return datetime 
     */
    public function getFechahorafin()
    {
        return $this->fechahorafin;
    }

    /**
     * Set encuestaactiva
     *
     * @param decimal $encuestaactiva
     */
    public function setEncuestaactiva($encuestaactiva)
    {
        $this->encuestaactiva = $encuestaactiva;
    }

    /**
     * Get encuestaactiva
     *
     * @return decimal 
     */
    public function getEncuestaactiva()
    {
        return $this->encuestaactiva;
    }
}