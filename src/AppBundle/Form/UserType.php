<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'required' => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Имя пользователя'
                )
            ))
            ->add('email', EmailType::class, array(
                'required' => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'E-mail'
                )
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'required' => false,
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'form.password'
                    )
                ),
                'second_options' => array(
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'form.password_confirmation'
                    )
                ),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('roles', ChoiceType::class, array(
                'required' => true,
                'choices' => array('Пользователь' => 'ROLE_USER', 'Админ' => 'ROLE_ADMIN'),
                'multiple' => true,
                'expanded'=>true,
                'label' => "Роль",
                'label_attr' => array('class' => 'checkbox-inline')
            ))
        ;

    }

    public function getName()
    {
        return 'app_bundle_user_type';
    }
}
