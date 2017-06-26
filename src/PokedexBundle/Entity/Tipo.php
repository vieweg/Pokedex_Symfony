<?php


namespace PokedexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("tipos")
 */
class Tipo {
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "IDENTITY")
     * @ORM\Column(type = "integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type = "string", length = 50)
     */
    private $nome;
    
    /**
     * @ORM\Column(type = "string", nullable = true, length = 255)
     */
    private $descricao;
    
    /**
     * @ORM\ManyToOne(targetEntity = "Tipo")
     */
    private $fraqueza;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    function getFraqueza() {
        return $this->fraqueza;
    }

    function setFraqueza(Tipo $fraqueza) {
        $this->fraqueza = $fraqueza;
    }
    
}
