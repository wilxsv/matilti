<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\ScdReglaSms
 */
class ScdReglaSms
{
    /**
     * @var bigint $id
     */
    private $id;

    /**
     * @var string $nombreregla
     */
    private $nombreregla;

    /**
     * @var string $prefijoregla
     */
    private $prefijoregla;

    /**
     * @var datetime $inicioregla
     */
    private $inicioregla;

    /**
     * @var datetime $finregla
     */
    private $finregla;

    /**
     * @var datetime $registroregla
     */
    private $registroregla;

    /**
     * @var string $descripcionregla
     */
    private $descripcionregla;

    /**
     * @var matilti\modeloBundle\Entity\ScdRol
     */
    private $rol;

    public function __construct()
    {
        $this->rol = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set nombreregla
     *
     * @param string $nombreregla
     */
    public function setNombreregla($nombreregla)
    {
        $this->nombreregla = $nombreregla;
    }

    /**
     * Get nombreregla
     *
     * @return string 
     */
    public function getNombreregla()
    {
        return $this->nombreregla;
    }

    /**
     * Set prefijoregla
     *
     * @param string $prefijoregla
     */
    public function setPrefijoregla($prefijoregla)
    {
        $this->prefijoregla = $prefijoregla;
    }

    /**
     * Get prefijoregla
     *
     * @return string 
     */
    public function getPrefijoregla()
    {
        return $this->prefijoregla;
    }

    /**
     * Set inicioregla
     *
     * @param datetime $inicioregla
     */
    public function setInicioregla($inicioregla)
    {
        $this->inicioregla = $inicioregla;
    }

    /**
     * Get inicioregla
     *
     * @return datetime 
     */
    public function getInicioregla()
    {
        return $this->inicioregla;
    }

    /**
     * Set finregla
     *
     * @param datetime $finregla
     */
    public function setFinregla($finregla)
    {
        $this->finregla = $finregla;
    }

    /**
     * Get finregla
     *
     * @return datetime 
     */
    public function getFinregla()
    {
        return $this->finregla;
    }

    /**
     * Set registroregla
     *
     * @param datetime $registroregla
     */
    public function setRegistroregla($registroregla)
    {
        $this->registroregla = $registroregla;
    }

    /**
     * Get registroregla
     *
     * @return datetime 
     */
    public function getRegistroregla()
    {
        return $this->registroregla;
    }

    /**
     * Set descripcionregla
     *
     * @param string $descripcionregla
     */
    public function setDescripcionregla($descripcionregla)
    {
        $this->descripcionregla = $descripcionregla;
    }

    /**
     * Get descripcionregla
     *
     * @return string 
     */
    public function getDescripcionregla()
    {
        return $this->descripcionregla;
    }

    /**
     * Add rol
     *
     * @param matilti\modeloBundle\Entity\ScdRol $rol
     */
    public function addScdRol(\matilti\modeloBundle\Entity\ScdRol $rol)
    {
        $this->rol[] = $rol;
    }

    /**
     * Get rol
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRol()
    {
        return $this->rol;
    }
}