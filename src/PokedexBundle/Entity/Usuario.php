<?php

namespace PokedexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name = "usuarios")
 */
class Usuario implements UserInterface, \Serializable {
    
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';
    
   /*const ROLES = [
        'Administrador' => self::ROLE_ADMIN,
        'Usuário' => self::ROLE_USER
    ];*/
    
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy = "IDENTITY")
    * @ORM\Column(type = "integer")
    */
    private $id;
    
    /** @ORM\Column(type = "string") */
    private $nome;
    
    /** @ORM\Column(type = "string") */
    private $email;
    
    /** @ORM\Column(type = "string", length = 100) */
    private $username;
    
    /** @ORM\Column(type = "string") */
    private $password;
    
    /** @ORM\Column(type = "string", length = 50) */
    private $role;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }
    
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }
    
    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = md5($password);
    }
    
    function getRole() {
        return $this->role;
    }

    function setRole($role) {
        $this->role = $role;
    }

    function eraseCredentials() {
        
    }

    function getRoles() {
        return [$this->role];
    }

    function getSalt() {
        return null;
    }
    
    function serialize() {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
            $this->email
        ]);
    }

    function unserialize($serialized) {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->email
        ) = unserialize($serialized);
    }

}
