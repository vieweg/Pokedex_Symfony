<?php

namespace PokedexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use PokedexBundle\Form\PokedexType;
use PokedexBundle\Service\PokemonManager;

/**
 * Description of IndexController
 *
 * @author Jhony
 */
class IndexController extends Controller {
    
    private $pokemonManager;
    
    function __construct(PokemonManager $pokemonManager) {
        $this->pokemonManager = $pokemonManager;
    }
    
    function indexAction(AuthenticationUtils $authenticationUtils) {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('Index/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
    
    function agendaAction(Request $request) {
        $form = $this->createForm(PokedexType::class);
        $form->handleRequest($request);
        $pokemon = null;
        if ($form->isSubmitted()) {
            $dados = $form->getData();
            $pokemon = $this->pokemonManager->buscarUm([
                'nome' => $dados['nome'], 
                'numero' => $dados['numero']
            ]);
        }
        return $this->render('Agenda/index.html.twig', [
            'form' => $form->createView(), 'pokemon' => $pokemon
        ]);
    }
    
}
