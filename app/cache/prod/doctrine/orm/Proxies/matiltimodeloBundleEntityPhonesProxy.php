<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class matiltimodeloBundleEntityPhonesProxy extends \matilti\modeloBundle\Entity\Phones implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }
    
    
    public function getImei()
    {
        $this->__load();
        return parent::getImei();
    }

    public function setId($id)
    {
        $this->__load();
        return parent::setId($id);
    }

    public function getId()
    {
        $this->__load();
        return parent::getId();
    }

    public function setUpdatedindb($updatedindb)
    {
        $this->__load();
        return parent::setUpdatedindb($updatedindb);
    }

    public function getUpdatedindb()
    {
        $this->__load();
        return parent::getUpdatedindb();
    }

    public function setInsertintodb($insertintodb)
    {
        $this->__load();
        return parent::setInsertintodb($insertintodb);
    }

    public function getInsertintodb()
    {
        $this->__load();
        return parent::getInsertintodb();
    }

    public function setTimeout($timeout)
    {
        $this->__load();
        return parent::setTimeout($timeout);
    }

    public function getTimeout()
    {
        $this->__load();
        return parent::getTimeout();
    }

    public function setSend($send)
    {
        $this->__load();
        return parent::setSend($send);
    }

    public function getSend()
    {
        $this->__load();
        return parent::getSend();
    }

    public function setReceive($receive)
    {
        $this->__load();
        return parent::setReceive($receive);
    }

    public function getReceive()
    {
        $this->__load();
        return parent::getReceive();
    }

    public function setClient($client)
    {
        $this->__load();
        return parent::setClient($client);
    }

    public function getClient()
    {
        $this->__load();
        return parent::getClient();
    }

    public function setBattery($battery)
    {
        $this->__load();
        return parent::setBattery($battery);
    }

    public function getBattery()
    {
        $this->__load();
        return parent::getBattery();
    }

    public function setSignal($signal)
    {
        $this->__load();
        return parent::setSignal($signal);
    }

    public function getSignal()
    {
        $this->__load();
        return parent::getSignal();
    }

    public function setSent($sent)
    {
        $this->__load();
        return parent::setSent($sent);
    }

    public function getSent()
    {
        $this->__load();
        return parent::getSent();
    }

    public function setReceived($received)
    {
        $this->__load();
        return parent::setReceived($received);
    }

    public function getReceived()
    {
        $this->__load();
        return parent::getReceived();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'imei', 'id', 'updatedindb', 'insertintodb', 'timeout', 'send', 'receive', 'client', 'battery', 'signal', 'sent', 'received');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}