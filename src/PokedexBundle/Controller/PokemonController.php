<?php

namespace PokedexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Psr\Log\LoggerInterface;
use PokedexBundle\Entity\Pokemon;
use PokedexBundle\Form\PokemonType;
use PokedexBundle\Service\PokemonManager;

/**
 * Description of RegiaoController
 *
 * @author jhony
 */
class PokemonController extends Controller {
    
    private $logger;
    private $pokemonManager;
    
    function __construct(PokemonManager $pokemonManager, LoggerInterface $logger = null) {
        $this->pokemonManager = $pokemonManager;
        $this->logger = $logger;
    }
    
    function listarAction(Request $request) {
        return $this->render('Pokemon/pokemons.html.twig', [
            'pokemons' => $this->pokemonManager->listar($request->query->all())
        ]);
    }
    
    function getImagemAction(Request $request, $id) {
        $pokemon = $this->pokemonManager->buscar($id);
        $basePath = $this->getParameter('kernel.project_dir');
        $imagem = file_get_contents($basePath . '/uploads/' . $pokemon->getImagem());
        return new Response($imagem, 200);
    }
    
    function criarAction(Request $request) {
        $pokemon = new Pokemon();
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->pokemonManager->inserir($pokemon);
            $this->addFlash('notice', 'Pokémon criado');
            return $this->redirectToRoute('listarPokemons');
        }
        return $this->render('Pokemon/form.html.twig', ['form' => $form->createView()]);
    }
    
    function atualizarAction(Request $request, $id) {
        $pokemon = $this->pokemonManager->buscar($id);
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->pokemonManager->atualizar($pokemon);
            $this->addFlash('notice', 'Pokémon atualizado');
            return $this->redirectToRoute('listarPokemons');
        }
        return $this->render('Pokemon/form.html.twig', [
            'pokemon' => $pokemon,
            'form' => $form->createView()
        ]);
    }
    
    function deletarAction($id) {
        $this->pokemonManager->remover($id);
        return $this->redirectToRoute('listarPokemons');
    }
    
}
