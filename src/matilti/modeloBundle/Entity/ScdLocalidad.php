<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\ScdLocalidad
 */
class ScdLocalidad
{
    /**
     * @var bigint $id
     */
    private $id;

    /**
     * @var string $nombrelocalidad
     */
    private $nombrelocalidad;

    /**
     * @var float $latlocalidad
     */
    private $latlocalidad;

    /**
     * @var float $loglocalidad
     */
    private $loglocalidad;

    /**
     * @var text $descripcionlocalidad
     */
    private $descripcionlocalidad;

    /**
     * @var bigint $poblacionlocalidad
     */
    private $poblacionlocalidad;

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
     * Set nombrelocalidad
     *
     * @param string $nombrelocalidad
     */
    public function setNombrelocalidad($nombrelocalidad)
    {
        $this->nombrelocalidad = $nombrelocalidad;
    }

    /**
     * Get nombrelocalidad
     *
     * @return string 
     */
    public function getNombrelocalidad()
    {
        return $this->nombrelocalidad;
    }

    /**
     * Set latlocalidad
     *
     * @param float $latlocalidad
     */
    public function setLatlocalidad($latlocalidad)
    {
        $this->latlocalidad = $latlocalidad;
    }

    /**
     * Get latlocalidad
     *
     * @return float 
     */
    public function getLatlocalidad()
    {
        return $this->latlocalidad;
    }

    /**
     * Set loglocalidad
     *
     * @param float $loglocalidad
     */
    public function setLoglocalidad($loglocalidad)
    {
        $this->loglocalidad = $loglocalidad;
    }

    /**
     * Get loglocalidad
     *
     * @return float 
     */
    public function getLoglocalidad()
    {
        return $this->loglocalidad;
    }

    /**
     * Set descripcionlocalidad
     *
     * @param text $descripcionlocalidad
     */
    public function setDescripcionlocalidad($descripcionlocalidad)
    {
        $this->descripcionlocalidad = $descripcionlocalidad;
    }

    /**
     * Get descripcionlocalidad
     *
     * @return text 
     */
    public function getDescripcionlocalidad()
    {
        return $this->descripcionlocalidad;
    }

    /**
     * Set poblacionlocalidad
     *
     * @param bigint $poblacionlocalidad
     */
    public function setPoblacionlocalidad($poblacionlocalidad)
    {
        $this->poblacionlocalidad = $poblacionlocalidad;
    }

    /**
     * Get poblacionlocalidad
     *
     * @return bigint 
     */
    public function getPoblacionlocalidad()
    {
        return $this->poblacionlocalidad;
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

    public function __toString(){
        return $this->getNombrelocalidad();
    }
}