<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\Outbox
 */
class Outbox
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
     * @var datetime $insertintodb
     */
    private $insertintodb;

    /**
     * @var datetime $sendingdatetime
     */
    private $sendingdatetime;

    /**
     * @var text $text
     */
    private $text;

    /**
     * @var string $destinationnumber
     */
    private $destinationnumber;

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
     * @var boolean $multipart
     */
    private $multipart;

    /**
     * @var integer $relativevalidity
     */
    private $relativevalidity;

    /**
     * @var string $senderid
     */
    private $senderid;

    /**
     * @var datetime $sendingtimeout
     */
    private $sendingtimeout;

    /**
     * @var string $deliveryreport
     */
    private $deliveryreport;

    /**
     * @var text $creatorid
     */
    private $creatorid;


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
     * Set insertintodb
     *
     * @param datetime $insertintodb
     */
    public function setInsertintodb($insertintodb)
    {
        $this->insertintodb = $insertintodb;
    }

    /**
     * Get insertintodb
     *
     * @return datetime 
     */
    public function getInsertintodb()
    {
        return $this->insertintodb;
    }

    /**
     * Set sendingdatetime
     *
     * @param datetime $sendingdatetime
     */
    public function setSendingdatetime($sendingdatetime)
    {
        $this->sendingdatetime = $sendingdatetime;
    }

    /**
     * Get sendingdatetime
     *
     * @return datetime 
     */
    public function getSendingdatetime()
    {
        return $this->sendingdatetime;
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
     * Set destinationnumber
     *
     * @param string $destinationnumber
     */
    public function setDestinationnumber($destinationnumber)
    {
        $this->destinationnumber = $destinationnumber;
    }

    /**
     * Get destinationnumber
     *
     * @return string 
     */
    public function getDestinationnumber()
    {
        return $this->destinationnumber;
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

    /**
     * Set multipart
     *
     * @param boolean $multipart
     */
    public function setMultipart($multipart)
    {
        $this->multipart = $multipart;
    }

    /**
     * Get multipart
     *
     * @return boolean 
     */
    public function getMultipart()
    {
        return $this->multipart;
    }

    /**
     * Set relativevalidity
     *
     * @param integer $relativevalidity
     */
    public function setRelativevalidity($relativevalidity)
    {
        $this->relativevalidity = $relativevalidity;
    }

    /**
     * Get relativevalidity
     *
     * @return integer 
     */
    public function getRelativevalidity()
    {
        return $this->relativevalidity;
    }

    /**
     * Set senderid
     *
     * @param string $senderid
     */
    public function setSenderid($senderid)
    {
        $this->senderid = $senderid;
    }

    /**
     * Get senderid
     *
     * @return string 
     */
    public function getSenderid()
    {
        return $this->senderid;
    }

    /**
     * Set sendingtimeout
     *
     * @param datetime $sendingtimeout
     */
    public function setSendingtimeout($sendingtimeout)
    {
        $this->sendingtimeout = $sendingtimeout;
    }

    /**
     * Get sendingtimeout
     *
     * @return datetime 
     */
    public function getSendingtimeout()
    {
        return $this->sendingtimeout;
    }

    /**
     * Set deliveryreport
     *
     * @param string $deliveryreport
     */
    public function setDeliveryreport($deliveryreport)
    {
        $this->deliveryreport = $deliveryreport;
    }

    /**
     * Get deliveryreport
     *
     * @return string 
     */
    public function getDeliveryreport()
    {
        return $this->deliveryreport;
    }

    /**
     * Set creatorid
     *
     * @param text $creatorid
     */
    public function setCreatorid($creatorid)
    {
        $this->creatorid = $creatorid;
    }

    /**
     * Get creatorid
     *
     * @return text 
     */
    public function getCreatorid()
    {
        return $this->creatorid;
    }
}