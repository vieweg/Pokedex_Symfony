<?php

namespace PokedexBundle\Service;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use PokedexBundle\Entity\Pokemon;
use PokedexBundle\Event\PokemonEvent;

class PokemonManager {
    
    private $entityManager;
    private $uploadPath;
    private $eventDispatcher;
    
    function __construct(EntityManagerInterface $em, EventDispatcherInterface $eventDispatcher, $uploadPath) {
        $this->entityManager = $em;
        $this->uploadPath = $uploadPath;
        $this->eventDispatcher = $eventDispatcher;
    }

    function paramMap() {
        return [
            'nome' => function(QueryBuilder $qb, $value) {
                $qb->andWhere('p.nome LIKE :nome')->setParameter('nome', "%{$value}%");
            },
            'numero' => function(QueryBuilder $qb, $value) {
                $qb->andWhere('p.numero = :numero')->setParameter('numero', $value);
            },
            'tipo' => function(QueryBuilder $qb, $value) {
                $qb->andWhere('p.tipo = :tipo')->setParameter('tipo', $value);
            }
        ];
    }
    
    function buscar($id) {
        $pokemon = $this->entityManager->find('PokedexBundle:Pokemon', $id);
        $file = new File($this->uploadPath . '/' . $pokemon->getImagem());
        $pokemon->setArquivoImagem($file);
        return $pokemon;
    }
    
    function buscarUm(array $params) {
        return $this->createQuery($params)->setMaxResults(1)->getOneOrNullResult();
    }
    
    function listar(array $params) {
        return $this->createQuery($params)->getResult();
    }
    
    private function createQuery(array $params) {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('p')->from('PokedexBundle:Pokemon', 'p');     
        $paramMap = $this->paramMap();
        foreach ($params as $name => $value) {
            if (key_exists($name, $paramMap) && !is_null($value)) {
                $paramMap[$name]($qb, $value);
            }
        }
        return $qb->orderBy('p.nome')->getQuery();
    }
    
    function inserir(Pokemon $pokemon) {
        $fileName = $pokemon->getNumero() . '.' . $pokemon->getArquivoImagem()->guessExtension();
        $pokemon->setImagem($fileName);
        $this->entityManager->persist($pokemon);
        $this->entityManager->flush();
        $this->eventDispatcher->dispatch('events.pokemon_criado', new PokemonEvent($pokemon));
        $pokemon->getArquivoImagem()->move($this->uploadPath, $fileName);
    }
    
    function atualizar(Pokemon $pokemon) {
        if ($pokemon->getArquivoImagem()) {
            $fileName = $pokemon->getNumero() . '.' . $pokemon->getArquivoImagem()->guessExtension();
            $pokemon->setImagem($fileName);
            $pokemon->getArquivoImagem()->move($this->uploadPath, $fileName);
        }
        $this->entityManager->merge($pokemon);
        $this->entityManager->flush();
    }
    
    function remover($id) {
        $pokemon = $this->entityManager->getReference('PokedexBundle:Pokemon', $id);
        $this->entityManager->remove($pokemon);
        $this->entityManager->flush();
    }
    
}
