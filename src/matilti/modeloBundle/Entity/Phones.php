<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\Phones
 */
class Phones
{
    /**
     * @var string $imei
     */
    private $imei;

    /**
     * @var text $id
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
     * @var datetime $timeout
     */
    private $timeout;

    /**
     * @var boolean $send
     */
    private $send;

    /**
     * @var boolean $receive
     */
    private $receive;

    /**
     * @var text $client
     */
    private $client;

    /**
     * @var integer $battery
     */
    private $battery;

    /**
     * @var integer $signal
     */
    private $signal;

    /**
     * @var integer $sent
     */
    private $sent;

    /**
     * @var integer $received
     */
    private $received;


    /**
     * Get imei
     *
     * @return string 
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * Set id
     *
     * @param text $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return text 
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
     * Set timeout
     *
     * @param datetime $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * Get timeout
     *
     * @return datetime 
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set send
     *
     * @param boolean $send
     */
    public function setSend($send)
    {
        $this->send = $send;
    }

    /**
     * Get send
     *
     * @return boolean 
     */
    public function getSend()
    {
        return $this->send;
    }

    /**
     * Set receive
     *
     * @param boolean $receive
     */
    public function setReceive($receive)
    {
        $this->receive = $receive;
    }

    /**
     * Get receive
     *
     * @return boolean 
     */
    public function getReceive()
    {
        return $this->receive;
    }

    /**
     * Set client
     *
     * @param text $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * Get client
     *
     * @return text 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set battery
     *
     * @param integer $battery
     */
    public function setBattery($battery)
    {
        $this->battery = $battery;
    }

    /**
     * Get battery
     *
     * @return integer 
     */
    public function getBattery()
    {
        return $this->battery;
    }

    /**
     * Set signal
     *
     * @param integer $signal
     */
    public function setSignal($signal)
    {
        $this->signal = $signal;
    }

    /**
     * Get signal
     *
     * @return integer 
     */
    public function getSignal()
    {
        return $this->signal;
    }

    /**
     * Set sent
     *
     * @param integer $sent
     */
    public function setSent($sent)
    {
        $this->sent = $sent;
    }

    /**
     * Get sent
     *
     * @return integer 
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * Set received
     *
     * @param integer $received
     */
    public function setReceived($received)
    {
        $this->received = $received;
    }

    /**
     * Get received
     *
     * @return integer 
     */
    public function getReceived()
    {
        return $this->received;
    }
}