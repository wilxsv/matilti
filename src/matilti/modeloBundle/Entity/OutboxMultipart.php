<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\OutboxMultipart
 */
class OutboxMultipart
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $sequenceposition
     */
    private $sequenceposition;

    /**
     * @var text $text
     */
    private $text;

    /**
     * @var string $coding
     */
    private $coding;

    /**
     * @var text $udh
     */
    private $udh;

    /**
     * @var integer $class
     */
    private $class;

    /**
     * @var text $textdecoded
     */
    private $textdecoded;


    /**
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

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
     * Set sequenceposition
     *
     * @param integer $sequenceposition
     */
    public function setSequenceposition($sequenceposition)
    {
        $this->sequenceposition = $sequenceposition;
    }

    /**
     * Get sequenceposition
     *
     * @return integer 
     */
    public function getSequenceposition()
    {
        return $this->sequenceposition;
    }

    /**
     * Set text
     *
     * @param text $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return text 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set coding
     *
     * @param string $coding
     */
    public function setCoding($coding)
    {
        $this->coding = $coding;
    }

    /**
     * Get coding
     *
     * @return string 
     */
    public function getCoding()
    {
        return $this->coding;
    }

    /**
     * Set udh
     *
     * @param text $udh
     */
    public function setUdh($udh)
    {
        $this->udh = $udh;
    }

    /**
     * Get udh
     *
     * @return text 
     */
    public function getUdh()
    {
        return $this->udh;
    }

    /**
     * Set class
     *
     * @param integer $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * Get class
     *
     * @return integer 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set textdecoded
     *
     * @param text $textdecoded
     */
    public function setTextdecoded($textdecoded)
    {
        $this->textdecoded = $textdecoded;
    }

    /**
     * Get textdecoded
     *
     * @return text 
     */
    public function getTextdecoded()
    {
        return $this->textdecoded;
    }
}