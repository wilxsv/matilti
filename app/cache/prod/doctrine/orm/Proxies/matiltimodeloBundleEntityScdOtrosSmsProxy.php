<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class matiltimodeloBundleEntityScdOtrosSmsProxy extends \matilti\modeloBundle\Entity\ScdOtrosSms implements \Doctrine\ORM\Proxy\Proxy
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
    
    
    public function getId()
    {
        $this->__load();
        return parent::getId();
    }

    public function setMensajeotrosms($mensajeotrosms)
    {
        $this->__load();
        return parent::setMensajeotrosms($mensajeotrosms);
    }

    public function getMensajeotrosms()
    {
        $this->__load();
        return parent::getMensajeotrosms();
    }

    public function setNumerootrosms($numerootrosms)
    {
        $this->__load();
        return parent::setNumerootrosms($numerootrosms);
    }

    public function getNumerootrosms()
    {
        $this->__load();
        return parent::getNumerootrosms();
    }

    public function setInboxId($inboxId)
    {
        $this->__load();
        return parent::setInboxId($inboxId);
    }

    public function getInboxId()
    {
        $this->__load();
        return parent::getInboxId();
    }

    public function setRegistrotrosms($registrotrosms)
    {
        $this->__load();
        return parent::setRegistrotrosms($registrotrosms);
    }

    public function getRegistrotrosms()
    {
        $this->__load();
        return parent::getRegistrotrosms();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'mensajeotrosms', 'numerootrosms', 'inboxId', 'registrotrosms');
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