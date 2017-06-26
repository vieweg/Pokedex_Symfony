<?php

namespace PokedexBundle\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use PokedexBundle\Event\PokemonEvent;

/**
 * Description of EnviarEmailListener
 *
 * @author jhony
 */
class EnviarEmailListener implements EventSubscriberInterface {
    
    private $mailer;
    private $user;
    
    function __construct(\Swift_Mailer $mailer, TokenStorageInterface $tokenStorage) {
        $this->mailer = $mailer;
        $this->user = $tokenStorage->getToken()->getUser();
    }
    
    static function getSubscribedEvents() {
        return ['events.pokemon_criado' => 'enviarEmail'];
    }

    function enviarEmail(PokemonEvent $event) {
        $message = (new \Swift_Message('Notificação Pokédex'))
            ->setFrom('naoresponda@pokedex.com')
            ->setTo($this->user->getEmail())
            ->setBody("Novo pokémon encontrado: {$event->getPokemon()->getNome()}");
        $this->mailer->send($message);
    }
    
}
