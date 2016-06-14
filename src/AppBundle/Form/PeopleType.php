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

class PeopleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'ФИО'
                ),
            ))
            ->add('vkId', TextType::class, array(
                'required' => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Ссылка нв VK'
                ),
            ))
            ->add('role', null, array(
                'required' => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Роль'
                ),
            ))
        ;

    }

    public function getName()
    {
        return 'app_bundle_people_type';
    }
}
