<?php

namespace PokedexBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of PokemonType
 *
 * @author jhony
 */
class PokemonType extends AbstractType {
    
    function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nome')
                ->add('descricao', TextareaType::class)
                ->add('numero', NumberType::class)
                ->add('tipo', EntityType::class, [
                    'class' => 'PokedexBundle:Tipo',
                    'choice_label' => 'nome',
                    'choice_value' => 'id'
                ])
                ->add('regiao', EntityType::class, [
                    'class' => 'PokedexBundle:Regiao',
                    'choice_label' => 'nome',
                    'choice_value' => 'id'
                ])
                ->add('arquivoImagem', FileType::class, ['required' => false])
                ->add('btnSalvar', SubmitType::class, ['label' => 'Salvar']);
    }
    
}
