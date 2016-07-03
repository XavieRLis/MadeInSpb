<?php

namespace AppBundle\Form;

use AppBundle\Entity\MusicProjectMember;
use AppBundle\Form\DataTransformer\VKLinkToMemberTransformer;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MusicProjectMemberType extends AbstractType
{
    private $manager;

    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('person', TextType::class, array(
                'required' => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Ссылка на профиль в ВК'
                ),
            ))
            ->add('role', null, array(
                'required' => true,
                'label' => false,
            ))
            ->add('startYear', IntegerType::class, array(
                'required' => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'год начала работы')
            ))
            ->add('endYear', IntegerType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'год ухода из проекта')
            ))
            ->add('contact', CheckboxType::class, array(
                'label' => 'Контакт?'
            ))
        ;
        $builder->get('person')
            ->addModelTransformer(new VKLinkToMemberTransformer($this->manager));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MusicProjectMember::class,
        ));
    }

    public function getName()
    {
        return 'app_bundle_musicprojectmember_type';
    }
}
