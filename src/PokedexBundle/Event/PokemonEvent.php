<?php

namespace PokedexBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use PokedexBundle\Entity\Pokemon;

/**
 * Description of PokemonEvent
 *
 * @author jhony
 */
class PokemonEvent extends Event {
    
    private $pokemon;
    
    function __construct(Pokemon $pokemon) {
        $this->pokemon = $pokemon;
    }
    
    function getPokemon() {
        return $this->pokemon;
    }
    
}
