<?php

namespace PokedexBundle\Form;

use PokedexBundle\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of RegiaoForm
 *
 * @author jhony
 */
class UsuarioType extends AbstractType {
    
    function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nome', null, ['label' => 'Nome'])
                ->add('username', null, ['label' => 'Login'])
                ->add('password', PasswordType::class, ['label' => 'Senha'])
                ->add('email', EmailType::class, ['label' => 'E-mail'])
                ->add('role', ChoiceType::class, [
                    'label' => 'Tipo',
                    'choices' => Usuario::ROLES,
                    'placeholder' => 'Selecione um tipo...'
                ])
                ->add('btnSalvar', SubmitType::class, ['label' => 'Salvar']);
    }
    
}
