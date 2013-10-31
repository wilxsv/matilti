<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\PbkGroups
 */
class PbkGroups
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var text $name
     */
    private $name;


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
     * Set name
     *
     * @param text $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return text 
     */
    public function getName()
    {
        return $this->name;
    }
}