<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\ScdEntidad
 */
class ScdEntidad
{
    /**
     * @var bigint $id
     */
    private $id;

    /**
     * @var string $nombreentidad
     */
    private $nombreentidad;

    /**
     * @var string $correoentidad
     */
    private $correoentidad;

    /**
     * @var string $telefonoentidad
     */
    private $telefonoentidad;

    /**
     * @var string $urlentidad
     */
    private $urlentidad;

    /**
     * @var text $xmlentidad
     */
    private $xmlentidad;

    /**
     * @var float $latentidad
     */
    private $latentidad;

    /**
     * @var float $lonentidad
     */
    private $lonentidad;

    /**
     * @var matilti\modeloBundle\Entity\ScdLocalidad
     */
    private $localidad;


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
     * Set nombreentidad
     *
     * @param string $nombreentidad
     */
    public function setNombreentidad($nombreentidad)
    {
        $this->nombreentidad = $nombreentidad;
    }

    /**
     * Get nombreentidad
     *
     * @return string 
     */
    public function getNombreentidad()
    {
        return $this->nombreentidad;
    }

    /**
     * Set correoentidad
     *
     * @param string $correoentidad
     */
    public function setCorreoentidad($correoentidad)
    {
        $this->correoentidad = $correoentidad;
    }

    /**
     * Get correoentidad
     *
     * @return string 
     */
    public function getCorreoentidad()
    {
        return $this->correoentidad;
    }

    /**
     * Set telefonoentidad
     *
     * @param string $telefonoentidad
     */
    public function setTelefonoentidad($telefonoentidad)
    {
        $this->telefonoentidad = $telefonoentidad;
    }

    /**
     * Get telefonoentidad
     *
     * @return string 
     */
    public function getTelefonoentidad()
    {
        return $this->telefonoentidad;
    }

    /**
     * Set urlentidad
     *
     * @param string $urlentidad
     */
    public function setUrlentidad($urlentidad)
    {
        $this->urlentidad = $urlentidad;
    }

    /**
     * Get urlentidad
     *
     * @return string 
     */
    public function getUrlentidad()
    {
        return $this->urlentidad;
    }

    /**
     * Set xmlentidad
     *
     * @param text $xmlentidad
     */
    public function setXmlentidad($xmlentidad)
    {
        $this->xmlentidad = $xmlentidad;
    }

    /**
     * Get xmlentidad
     *
     * @return text 
     */
    public function getXmlentidad()
    {
        return $this->xmlentidad;
    }

    /**
     * Set latentidad
     *
     * @param float $latentidad
     */
    public function setLatentidad($latentidad)
    {
        $this->latentidad = $latentidad;
    }

    /**
     * Get latentidad
     *
     * @return float 
     */
    public function getLatentidad()
    {
        return $this->latentidad;
    }

    /**
     * Set lonentidad
     *
     * @param float $lonentidad
     */
    public function setLonentidad($lonentidad)
    {
        $this->lonentidad = $lonentidad;
    }

    /**
     * Get lonentidad
     *
     * @return float 
     */
    public function getLonentidad()
    {
        return $this->lonentidad;
    }

    /**
     * Set localidad
     *
     * @param matilti\modeloBundle\Entity\ScdLocalidad $localidad
     */
    public function setLocalidad(\matilti\modeloBundle\Entity\ScdLocalidad $localidad)
    {
        $this->localidad = $localidad;
    }

    /**
     * Get localidad
     *
     * @return matilti\modeloBundle\Entity\ScdLocalidad 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }
    /**
     * @var matilti\modeloBundle\Entity\ScdUsuario
     */
    private $usuario;

    public function __construct()
    {
        $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add usuario
     *
     * @param matilti\modeloBundle\Entity\ScdUsuario $usuario
     */
    public function addScdUsuario(\matilti\modeloBundle\Entity\ScdUsuario $usuario)
    {
        $this->usuario[] = $usuario;
    }

    /**
     * Get usuario
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function __toString(){
        return $this->getNombreentidad();
    }
}