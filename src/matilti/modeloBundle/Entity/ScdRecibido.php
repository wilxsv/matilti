<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\ScdRecibido
 */
class ScdRecibido
{
    /**
     * @var bigint $id
     */
    private $id;

    /**
     * @var string $mensajerecibido
     */
    private $mensajerecibido;

    /**
     * @var datetime $fecharecibido
     */
    private $fecharecibido;

    /**
     * @var bigint $reglaId
     */
    private $reglaId;

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
     * Set mensajerecibido
     *
     * @param string $mensajerecibido
     */
    public function setMensajerecibido($mensajerecibido)
    {
        $this->mensajerecibido = $mensajerecibido;
    }

    /**
     * Get mensajerecibido
     *
     * @return string 
     */
    public function getMensajerecibido()
    {
        return $this->mensajerecibido;
    }

    /**
     * Set fecharecibido
     *
     * @param datetime $fecharecibido
     */
    public function setFecharecibido($fecharecibido)
    {
        $this->fecharecibido = $fecharecibido;
    }

    /**
     * Get fecharecibido
     *
     * @return datetime 
     */
    public function getFecharecibido()
    {
        return $this->fecharecibido;
    }

    /**
     * Set reglaId
     *
     * @param bigint $reglaId
     */
    public function setReglaId($reglaId)
    {
        $this->reglaId = $reglaId;
    }

    /**
     * Get reglaId
     *
     * @return bigint 
     */
    public function getReglaId()
    {
        return $this->reglaId;
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
     * @var datetime $fechahorarecibido
     */
    private $fechahorarecibido;

    /**
     * @var matilti\modeloBundle\Entity\ScdReglaSms
     */
    private $regla;


    /**
     * Set fechahorarecibido
     *
     * @param datetime $fechahorarecibido
     */
    public function setFechahorarecibido($fechahorarecibido)
    {
        $this->fechahorarecibido = $fechahorarecibido;
    }

    /**
     * Get fechahorarecibido
     *
     * @return datetime 
     */
    public function getFechahorarecibido()
    {
        return $this->fechahorarecibido;
    }

    /**
     * Set regla
     *
     * @param matilti\modeloBundle\Entity\ScdReglaSms $regla
     */
    public function setRegla(\matilti\modeloBundle\Entity\ScdReglaSms $regla)
    {
        $this->regla = $regla;
    }

    /**
     * Get regla
     *
     * @return matilti\modeloBundle\Entity\ScdReglaSms 
     */
    public function getRegla()
    {
        return $this->regla;
    }
}