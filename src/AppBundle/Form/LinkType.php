<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\UrlType;


class LinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', UrlType::class, array(
                'required' => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Ссылка'
                ),
            ))
            ->add('type', null, array(
                'required' => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Ресурс'
                ),
            ))
        ;

    }

    public function getName()
    {
        return 'app_bundle_link_type';
    }
}
