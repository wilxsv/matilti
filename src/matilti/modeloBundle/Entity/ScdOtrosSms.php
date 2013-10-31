<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\ScdOtrosSms
 */
class ScdOtrosSms
{
    /**
     * @var bigint $id
     */
    private $id;

    /**
     * @var text $mensajeotrosms
     */
    private $mensajeotrosms;

    /**
     * @var string $numerootrosms
     */
    private $numerootrosms;

    /**
     * @var bigint $inboxId
     */
    private $inboxId;

    /**
     * @var datetime $registrotrosms
     */
    private $registrotrosms;


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
     * Set mensajeotrosms
     *
     * @param text $mensajeotrosms
     */
    public function setMensajeotrosms($mensajeotrosms)
    {
        $this->mensajeotrosms = $mensajeotrosms;
    }

    /**
     * Get mensajeotrosms
     *
     * @return text 
     */
    public function getMensajeotrosms()
    {
        return $this->mensajeotrosms;
    }

    /**
     * Set numerootrosms
     *
     * @param string $numerootrosms
     */
    public function setNumerootrosms($numerootrosms)
    {
        $this->numerootrosms = $numerootrosms;
    }

    /**
     * Get numerootrosms
     *
     * @return string 
     */
    public function getNumerootrosms()
    {
        return $this->numerootrosms;
    }

    /**
     * Set inboxId
     *
     * @param bigint $inboxId
     */
    public function setInboxId($inboxId)
    {
        $this->inboxId = $inboxId;
    }

    /**
     * Get inboxId
     *
     * @return bigint 
     */
    public function getInboxId()
    {
        return $this->inboxId;
    }

    /**
     * Set registrotrosms
     *
     * @param datetime $registrotrosms
     */
    public function setRegistrotrosms($registrotrosms)
    {
        $this->registrotrosms = $registrotrosms;
    }

    /**
     * Get registrotrosms
     *
     * @return datetime 
     */
    public function getRegistrotrosms()
    {
        return $this->registrotrosms;
    }
}