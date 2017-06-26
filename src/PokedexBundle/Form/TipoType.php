<?php

namespace PokedexBundle\Form;

use PokedexBundle\Entity\Tipo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of RegiaoForm
 *
 * @author jhony
 */
class TipoType extends AbstractType {
    
    function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nome', null, ['label' => 'Nome', 
                                    'required' => true])
                ->add('descricao', TextareaType::class, [
                    'label' => 'Descrição',
                    'required' => false
                ])
                ->add('fraqueza', EntityType::class, [
                    'label' => 'Fraqueza',
                    'required' => false,
                    'placeholder' => 'Selecione um valor...',
                    'class' => Tipo::class,
                    'choice_label' => 'nome',
                    'choice_value' => 'id'
                ])
                ->add('btnSalvar', SubmitType::class, ['label' => 'Salvar']);
    }
    
}
