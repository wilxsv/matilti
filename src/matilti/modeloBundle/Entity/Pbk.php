<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\Pbk
 */
class Pbk
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $groupid
     */
    private $groupid;

    /**
     * @var text $name
     */
    private $name;

    /**
     * @var text $number
     */
    private $number;


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
     * Set groupid
     *
     * @param integer $groupid
     */
    public function setGroupid($groupid)
    {
        $this->groupid = $groupid;
    }

    /**
     * Get groupid
     *
     * @return integer 
     */
    public function getGroupid()
    {
        return $this->groupid;
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

    /**
     * Set number
     *
     * @param text $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * Get number
     *
     * @return text 
     */
    public function getNumber()
    {
        return $this->number;
    }
}