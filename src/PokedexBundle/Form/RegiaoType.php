<?php

namespace PokedexBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use PokedexBundle\Entity\Regiao;

/**
 * Description of RegiaoForm
 *
 * @author jhony
 */
class RegiaoType extends AbstractType {
    
    function buildForm(FormBuilderInterface $builder, array $options) {
        //Alteração para adquar ao php 5.5.12 não suporta const array
        $climas = [
            Regiao::CLIMA_FRIO => Regiao::CLIMA_FRIO, 
            Regiao::CLIMA_QUENTE => Regiao::CLIMA_QUENTE,
            Regiao::CLIMA_TEMPERADO => Regiao::CLIMA_TEMPERADO
        ];
        $builder->add('nome', null, ['label' => 'Nome', 'required' => true])
                ->add('clima', ChoiceType::class, [
                    'label' => 'Clima',
                    'required' => true,
                    'choices' => $climas,
                    'placeholder' => 'Selecione um clima...'
                ])
                ->add('btnSalvar', SubmitType::class, ['label' => 'Salvar']);
    }
    
}
