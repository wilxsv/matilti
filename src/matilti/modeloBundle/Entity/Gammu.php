<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\Gammu
 */
class Gammu
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var smallint $version
     */
    private $version;


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
     * Set version
     *
     * @param smallint $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * Get version
     *
     * @return smallint 
     */
    public function getVersion()
    {
        return $this->version;
    }
}