<?php

namespace PokedexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("regioes")
 */
class Regiao {
    
    const CLIMA_QUENTE = 'Quente';
    const CLIMA_FRIO = 'Frio';
    const CLIMA_TEMPERADO = 'Temperado';
    
    //php 5.5.12 não suporta const array
    /*const  CLIMAS = [
        self::CLIMA_FRIO => self::CLIMA_FRIO, 
        self::CLIMA_QUENTE => self::CLIMA_QUENTE,
        self::CLIMA_TEMPERADO => self::CLIMA_TEMPERADO
    ];*/
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "IDENTITY")
     * @ORM\Column(type = "integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type = "string", nullable = false, length = 100)
     */
    private $nome;
    
    /**
     * @ORM\Column(type = "string", nullable = false)
     */
    private $clima;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getClima() {
        return $this->clima;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setClima($clima) {
        $this->clima = $clima;
    }
    
}
