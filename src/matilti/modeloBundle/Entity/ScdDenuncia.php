<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\ScdDenuncia
 */
class ScdDenuncia
{
    /**
     * @var bigint $id
     */
    private $id;

    /**
     * @var string $mensajedenuncia
     */
    private $mensajedenuncia;

    /**
     * @var datetime $fechahorainicio
     */
    private $fechahorainicio;

    /**
     * @var datetime $fechahorafin
     */
    private $fechahorafin;

    /**
     * @var decimal $denunciaactiva
     */
    private $denunciaactiva;

    /**
     * @var matilti\modeloBundle\Entity\ScdDenuncia
     */
    private $denuncia;

    /**
     * @var matilti\modeloBundle\Entity\ScdUsuario
     */
    private $usuario;

    /**
     * @var matilti\modeloBundle\Entity\ScdEntidad
     */
    private $entidad;


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
     * Set mensajedenuncia
     *
     * @param string $mensajedenuncia
     */
    public function setMensajedenuncia($mensajedenuncia)
    {
        $this->mensajedenuncia = $mensajedenuncia;
    }

    /**
     * Get mensajedenuncia
     *
     * @return string 
     */
    public function getMensajedenuncia()
    {
        return $this->mensajedenuncia;
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
     * Set denunciaactiva
     *
     * @param decimal $denunciaactiva
     */
    public function setDenunciaactiva($denunciaactiva)
    {
        $this->denunciaactiva = $denunciaactiva;
    }

    /**
     * Get denunciaactiva
     *
     * @return decimal 
     */
    public function getDenunciaactiva()
    {
        return $this->denunciaactiva;
    }

    /**
     * Set denuncia
     *
     * @param matilti\modeloBundle\Entity\ScdDenuncia $denuncia
     */
    public function setDenuncia(\matilti\modeloBundle\Entity\ScdDenuncia $denuncia)
    {
        $this->denuncia = $denuncia;
    }

    /**
     * Get denuncia
     *
     * @return matilti\modeloBundle\Entity\ScdDenuncia 
     */
    public function getDenuncia()
    {
        return $this->denuncia;
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

    /**
     * Set entidad
     *
     * @param matilti\modeloBundle\Entity\ScdEntidad $entidad
     */
    public function setEntidad(\matilti\modeloBundle\Entity\ScdEntidad $entidad)
    {
        $this->entidad = $entidad;
    }

    /**
     * Get entidad
     *
     * @return matilti\modeloBundle\Entity\ScdEntidad 
     */
    public function getEntidad()
    {
        return $this->entidad;
    }
    
    public function __toString(){
        return $this->getId();
    }
}
