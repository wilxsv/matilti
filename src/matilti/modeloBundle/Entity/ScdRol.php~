<?php

namespace matilti\modeloBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * matilti\modeloBundle\Entity\ScdRol
 */
class ScdRol implements RoleInterface
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $nombrerol
     * @ORM\Column(name="nombrerol", type="string", nullable=false, length=75, unique=true)
     ****Regex(pattern="/\d/", match=false, message="Campo no puede contener numeros")
     */
    private $nombrerol;

    /**
     * @var text $detallerol
     */
    private $detallerol;

    /**
     * @var matilti\modeloBundle\Entity\ScdReglaSms
     */
    private $regla;

    /**
     * @var matilti\modeloBundle\Entity\ScdUsuario
     */
    private $usuario;

    public function __construct()
    {
        $this->regla = new \Doctrine\Common\Collections\ArrayCollection();
    $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombrerol
     *
     * @param string $nombrerol
     */
    public function setNombrerol($nombrerol)
    {
        $this->nombrerol = $nombrerol;
    }

    /**
     * Get nombrerol
     *
     * @return string 
     */
    public function getNombrerol()
    {
        return $this->nombrerol;
    }

    /**
     * Set detallerol
     *
     * @param text $detallerol
     */
    public function setDetallerol($detallerol)
    {
        $this->detallerol = $detallerol;
    }

    /**
     * Get detallerol
     *
     * @return text 
     */
    public function getDetallerol()
    {
        return $this->detallerol;
    }

    /**
     * Add regla
     *
     * @param matilti\modeloBundle\Entity\ScdReglaSms $regla
     */
    public function addScdReglaSms(\matilti\modeloBundle\Entity\ScdReglaSms $regla)
    {
        $this->regla[] = $regla;
    }

    /**
     * Get regla
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRegla()
    {
        return $this->regla;
    }

    /**
     * Add usuario
     *
     * @param matilti\modeloBundle\Entity\ScdUsuario $usuario
     */
    public function addScdUsuario(\matilti\modeloBundle\Entity\ScdUsuario $usuario)
    {
        $this->usuario[] = $usuario;
    }

    /**
     * Get usuario
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    
    public function __toString(){
        return $this->getNombrerol();
    }
    
    /**
     * Implementation of getRole for the RoleInterface.
     * 
     * @return string The role.
     */
    public function getRole()
    {
        return $this->getNombrerol();
    }

}