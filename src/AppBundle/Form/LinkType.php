<?php

namespace AppBundle\Form;

use AppBundle\Entity\Link;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('mainResource', CheckboxType::class, array(
                'label' => 'Основной ресурс',
            ))
        ;

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Link::class
        ));
    }

    public function getName()
    {
        return 'app_bundle_link_type';
    }
}
