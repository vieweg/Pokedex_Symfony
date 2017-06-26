<?php

namespace PokedexBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of PokedexForm
 *
 * @author jhony
 */
class PokedexType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('numero', null, ['label' => 'Número'])
                ->add('nome', null, ['label' => 'Nome']);
    }
    
}
