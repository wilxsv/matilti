<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class matiltimodeloBundleEntityScdReglaSmsProxy extends \matilti\modeloBundle\Entity\ScdReglaSms implements \Doctrine\ORM\Proxy\Proxy
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

    public function setNombreregla($nombreregla)
    {
        $this->__load();
        return parent::setNombreregla($nombreregla);
    }

    public function getNombreregla()
    {
        $this->__load();
        return parent::getNombreregla();
    }

    public function setPrefijoregla($prefijoregla)
    {
        $this->__load();
        return parent::setPrefijoregla($prefijoregla);
    }

    public function getPrefijoregla()
    {
        $this->__load();
        return parent::getPrefijoregla();
    }

    public function setInicioregla($inicioregla)
    {
        $this->__load();
        return parent::setInicioregla($inicioregla);
    }

    public function getInicioregla()
    {
        $this->__load();
        return parent::getInicioregla();
    }

    public function setFinregla($finregla)
    {
        $this->__load();
        return parent::setFinregla($finregla);
    }

    public function getFinregla()
    {
        $this->__load();
        return parent::getFinregla();
    }

    public function setRegistroregla($registroregla)
    {
        $this->__load();
        return parent::setRegistroregla($registroregla);
    }

    public function getRegistroregla()
    {
        $this->__load();
        return parent::getRegistroregla();
    }

    public function setDescripcionregla($descripcionregla)
    {
        $this->__load();
        return parent::setDescripcionregla($descripcionregla);
    }

    public function getDescripcionregla()
    {
        $this->__load();
        return parent::getDescripcionregla();
    }

    public function addScdRol(\matilti\modeloBundle\Entity\ScdRol $rol)
    {
        $this->__load();
        return parent::addScdRol($rol);
    }

    public function getRol()
    {
        $this->__load();
        return parent::getRol();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'nombreregla', 'prefijoregla', 'inicioregla', 'finregla', 'registroregla', 'descripcionregla', 'rol');
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