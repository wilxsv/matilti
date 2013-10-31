<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\Inbox
 */
class Inbox
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var datetime $updatedindb
     */
    private $updatedindb;

    /**
     * @var datetime $receivingdatetime
     */
    private $receivingdatetime;

    /**
     * @var text $text
     */
    private $text;

    /**
     * @var string $sendernumber
     */
    private $sendernumber;

    /**
     * @var string $coding
     */
    private $coding;

    /**
     * @var text $udh
     */
    private $udh;

    /**
     * @var string $smscnumber
     */
    private $smscnumber;

    /**
     * @var integer $class
     */
    private $class;

    /**
     * @var text $textdecoded
     */
    private $textdecoded;

    /**
     * @var text $recipientid
     */
    private $recipientid;

    /**
     * @var boolean $processed
     */
    private $processed;


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
     * Set updatedindb
     *
     * @param datetime $updatedindb
     */
    public function setUpdatedindb($updatedindb)
    {
        $this->updatedindb = $updatedindb;
    }

    /**
     * Get updatedindb
     *
     * @return datetime 
     */
    public function getUpdatedindb()
    {
        return $this->updatedindb;
    }

    /**
     * Set receivingdatetime
     *
     * @param datetime $receivingdatetime
     */
    public function setReceivingdatetime($receivingdatetime)
    {
        $this->receivingdatetime = $receivingdatetime;
    }

    /**
     * Get receivingdatetime
     *
     * @return datetime 
     */
    public function getReceivingdatetime()
    {
        return $this->receivingdatetime;
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
     * Set sendernumber
     *
     * @param string $sendernumber
     */
    public function setSendernumber($sendernumber)
    {
        $this->sendernumber = $sendernumber;
    }

    /**
     * Get sendernumber
     *
     * @return string 
     */
    public function getSendernumber()
    {
        return $this->sendernumber;
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
     * Set smscnumber
     *
     * @param string $smscnumber
     */
    public function setSmscnumber($smscnumber)
    {
        $this->smscnumber = $smscnumber;
    }

    /**
     * Get smscnumber
     *
     * @return string 
     */
    public function getSmscnumber()
    {
        return $this->smscnumber;
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

    /**
     * Set recipientid
     *
     * @param text $recipientid
     */
    public function setRecipientid($recipientid)
    {
        $this->recipientid = $recipientid;
    }

    /**
     * Get recipientid
     *
     * @return text 
     */
    public function getRecipientid()
    {
        return $this->recipientid;
    }

    /**
     * Set processed
     *
     * @param boolean $processed
     */
    public function setProcessed($processed)
    {
        $this->processed = $processed;
    }

    /**
     * Get processed
     *
     * @return boolean 
     */
    public function getProcessed()
    {
        return $this->processed;
    }
}