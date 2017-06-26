<?php

namespace PokedexBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("pokemons")
 */
class Pokemon {
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "IDENTITY")
     * @ORM\Column(type = "integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type = "string", length = 100)
     */
    private $nome;
    
    /**
    * @ORM\Column(type = "string", length = 255)
    */
    private $descricao;
    
    /**
     * @ORM\Column(type = "integer", unique = true)
     */
    private $numero;
    
    /**
     * @ORM\ManyToOne(targetEntity = "Tipo")
     */
    private $tipo;
    
    /**
     * @ORM\ManyToOne(targetEntity = "Regiao")
     */
    private $regiao;
    
    /**
     * @ORM\Column(name = "data_cadastro", type = "datetime")
     */
    private $dataCadastro;
    
    /**
     * @ORM\Column(type = "string", length = 255, nullable = true)
     */
    private $imagem;
    
    private $arquivoImagem;
    
    function __construct() {
        $this->dataCadastro = new \DateTime('now');
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getNumero() {
        return $this->numero;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getRegiao() {
        return $this->regiao;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getImagem() {
        return $this->imagem;
    }
    
    function getDescricao() {
        return $this->descricao;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    function setNome($nome) {
        $this->nome = $nome;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setTipo(Tipo $tipo) {
        $this->tipo = $tipo;
    }

    function setRegiao(Regiao $regiao) {
        $this->regiao = $regiao;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }
    
    function getArquivoImagem() {
        return $this->arquivoImagem;
    }

    function setArquivoImagem(File $arquivoImagem = null) {
        $this->arquivoImagem = $arquivoImagem;
    }
    
}
