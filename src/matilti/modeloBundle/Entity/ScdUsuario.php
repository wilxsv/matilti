<?php

namespace matilti\modeloBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * matilti\modeloBundle\Entity\ScdUsuario
 */
class ScdUsuario  implements UserInterface, \Serializable
{
    /**
     * @var bigint $id
     */
    private $id;

    /**
     * @var string $username
     */
    private $username;

    /**
     * @var text $password
     */
    private $password;

    /**
     * @var string $correousuario
     */
    private $correousuario;

    /**
     * @var text $detalleusuario
     */
    private $detalleusuario;

    /**
     * @var datetime $ultimavisitausuario
     */
    private $ultimavisitausuario;

    /**
     * @var string $ipusuario
     */
    private $ipusuario;

    /**
     * @var text $salt
     */
    private $salt;

    /**
     * @var string $nombreusuario
     */
    private $nombreusuario;

    /**
     * @var string $apellidousuario
     */
    private $apellidousuario;

    /**
     * @var bigint $telefonousuario
     */
    private $telefonousuario;

    /**
     * @var date $nacimientousuario
     */
    private $nacimientousuario;

    /**
     * @var float $latusuario
     */
    private $latusuario;

    /**
     * @var float $lonusuario
     */
    private $lonusuario;

    /**
     * @var text $direccionusuario
     */
    private $direccionusuario;

    /**
     * @var decimal $sexousuario
     */
    private $sexousuario;

    /**
     * @var datetime $registrousuario
     */
    private $registrousuario;

    /**
     * @var text $cuentausuario
     */
    private $cuentausuario;

    /**
     * @var text $imagenusuario
     */
    private $imagenusuario;

    /**
     * @var matilti\modeloBundle\Entity\ScdEstado
     */
    private $estado;

    /**
     * @var matilti\modeloBundle\Entity\ScdLocalidad
     */
    private $localidad;

    /**
     * @var matilti\modeloBundle\Entity\ScdRol
     */
    private $rol;

    public function __construct()
    {
        $this->rol = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return bigint 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param text $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return text 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set correousuario
     *
     * @param string $correousuario
     */
    public function setCorreousuario($correousuario)
    {
        $this->correousuario = $correousuario;
    }

    /**
     * Get correousuario
     *
     * @return string 
     */
    public function getCorreousuario()
    {
        return $this->correousuario;
    }

    /**
     * Set detalleusuario
     *
     * @param text $detalleusuario
     */
    public function setDetalleusuario($detalleusuario)
    {
        $this->detalleusuario = $detalleusuario;
    }

    /**
     * Get detalleusuario
     *
     * @return text 
     */
    public function getDetalleusuario()
    {
        return $this->detalleusuario;
    }

    /**
     * Set ultimavisitausuario
     *
     * @param datetime $ultimavisitausuario
     */
    public function setUltimavisitausuario($ultimavisitausuario)
    {
        $this->ultimavisitausuario = $ultimavisitausuario;
    }

    /**
     * Get ultimavisitausuario
     *
     * @return datetime 
     */
    public function getUltimavisitausuario()
    {
        return $this->ultimavisitausuario;
    }

    /**
     * Set ipusuario
     *
     * @param string $ipusuario
     */
    public function setIpusuario($ipusuario)
    {
        $this->ipusuario = $ipusuario;
    }

    /**
     * Get ipusuario
     *
     * @return string 
     */
    public function getIpusuario()
    {
        return $this->ipusuario;
    }

    /**
     * Set salt
     *
     * @param text $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return text 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set nombreusuario
     *
     * @param string $nombreusuario
     */
    public function setNombreusuario($nombreusuario)
    {
        $this->nombreusuario = $nombreusuario;
    }

    /**
     * Get nombreusuario
     *
     * @return string 
     */
    public function getNombreusuario()
    {
        return $this->nombreusuario;
    }

    /**
     * Set apellidousuario
     *
     * @param string $apellidousuario
     */
    public function setApellidousuario($apellidousuario)
    {
        $this->apellidousuario = $apellidousuario;
    }

    /**
     * Get apellidousuario
     *
     * @return string 
     */
    public function getApellidousuario()
    {
        return $this->apellidousuario;
    }

    /**
     * Set telefonousuario
     *
     * @param bigint $telefonousuario
     */
    public function setTelefonousuario($telefonousuario)
    {
        $this->telefonousuario = $telefonousuario;
    }

    /**
     * Get telefonousuario
     *
     * @return bigint 
     */
    public function getTelefonousuario()
    {
        return $this->telefonousuario;
    }

    /**
     * Set nacimientousuario
     *
     * @param date $nacimientousuario
     */
    public function setNacimientousuario($nacimientousuario)
    {
        $this->nacimientousuario = $nacimientousuario;
    }

    /**
     * Get nacimientousuario
     *
     * @return date 
     */
    public function getNacimientousuario()
    {
        return $this->nacimientousuario;
    }

    /**
     * Set latusuario
     *
     * @param float $latusuario
     */
    public function setLatusuario($latusuario)
    {
        $this->latusuario = $latusuario;
    }

    /**
     * Get latusuario
     *
     * @return float 
     */
    public function getLatusuario()
    {
        return $this->latusuario;
    }

    /**
     * Set lonusuario
     *
     * @param float $lonusuario
     */
    public function setLonusuario($lonusuario)
    {
        $this->lonusuario = $lonusuario;
    }

    /**
     * Get lonusuario
     *
     * @return float 
     */
    public function getLonusuario()
    {
        return $this->lonusuario;
    }

    /**
     * Set direccionusuario
     *
     * @param text $direccionusuario
     */
    public function setDireccionusuario($direccionusuario)
    {
        $this->direccionusuario = $direccionusuario;
    }

    /**
     * Get direccionusuario
     *
     * @return text 
     */
    public function getDireccionusuario()
    {
        return $this->direccionusuario;
    }

    /**
     * Set sexousuario
     *
     * @param decimal $sexousuario
     */
    public function setSexousuario($sexousuario)
    {
        $this->sexousuario = $sexousuario;
    }

    /**
     * Get sexousuario
     *
     * @return decimal 
     */
    public function getSexousuario()
    {
        return $this->sexousuario;
    }

    /**
     * Set registrousuario
     *
     * @param datetime $registrousuario
     */
    public function setRegistrousuario($registrousuario)
    {
        $this->registrousuario = $registrousuario;
    }

    /**
     * Get registrousuario
     *
     * @return datetime 
     */
    public function getRegistrousuario()
    {
        return $this->registrousuario;
    }

    /**
     * Set cuentausuario
     *
     * @param text $cuentausuario
     */
    public function setCuentausuario($cuentausuario)
    {
        $this->cuentausuario = $cuentausuario;
    }

    /**
     * Get cuentausuario
     *
     * @return text 
     */
    public function getCuentausuario()
    {
        return $this->cuentausuario;
    }

    /**
     * Set imagenusuario
     *
     * @param text $imagenusuario
     */
    public function setImagenusuario($imagenusuario)
    {
        $this->imagenusuario = $imagenusuario;
    }

    /**
     * Get imagenusuario
     *
     * @return text 
     */
    public function getImagenusuario()
    {
        return $this->imagenusuario;
    }

    /**
     * Set estado
     *
     * @param matilti\modeloBundle\Entity\ScdEstado $estado
     */
    public function setEstado(\matilti\modeloBundle\Entity\ScdEstado $estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get estado
     *
     * @return matilti\modeloBundle\Entity\ScdEstado 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set localidad
     *
     * @param matilti\modeloBundle\Entity\ScdLocalidad $localidad
     */
    public function setLocalidad(\matilti\modeloBundle\Entity\ScdLocalidad $localidad)
    {
        $this->localidad = $localidad;
    }

    /**
     * Get localidad
     *
     * @return matilti\modeloBundle\Entity\ScdLocalidad 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Add rol
     *
     * @param matilti\modeloBundle\Entity\ScdRol $rol
     */
    public function addScdRol(\matilti\modeloBundle\Entity\ScdRol $rol)
    {
        $this->rol[] = $rol;
    }

    /**
     * Get rol
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRol()
    {
        return $this->rol;
    }
    
    /* Add own*/
    public function eraseCredentials()
    {
 
    }
    /**
     * Gets an array of roles.
     * 
     * @return array An array of Role objects
     */
    public function getRoles()
    {
        return $this->getUserRoles()->toArray();
        $callback = create_function($obj,"return $obj->getNombrerol()");
        $roleObjsArray = $this->getUserRoles()->toArray();
        return array_map($callback,$roleObjsArray);


    }
 
    /**
     * Compares this user to another to determine if they are the same.
     * 
     * @param UserInterface $user The user
     * @return boolean True if equal, false othwerwise.
     */
    public function equals(UserInterface $user)
    {
        return md5($this->getUsername()) == md5($user->getUsername());
    }

    public function __toString(){
     return $this->getUsername();
    }

    public function getUserRoles()
    {
        return $this->getRol();
    }

    public function serialize()
    {
       return serialize($this->getId());
    }
 
    public function unserialize($data)
    {
        $this->id = unserialize($data);
    }

    /**
     * @var matilti\modeloBundle\Entity\ScdEntidad
     */
    public $entidad;


    /**
     * Add entidad
     *
     * @param matilti\modeloBundle\Entity\ScdEntidad $entidad
     */
    public function addScdEntidad(\matilti\modeloBundle\Entity\ScdEntidad $entidad)
    {
        $this->entidad[] = $entidad;
    }

    /**
     * Get entidad
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEntidad()
    {
        return $this->entidad;
    }
}