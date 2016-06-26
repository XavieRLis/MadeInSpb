<?php

namespace AppBundle\Form;

use AppBundle\Entity\MusicProject;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MusicProjectType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $years = array_combine(range(date("Y"), 1970), range(date("Y"), 1970));
        $builder
            ->add('startYear', ChoiceType::class, array(
                'required' => false,
                'label' => 'Год основания',
                'choices' => $years,
            ))
            ->add('endYear', ChoiceType::class, array(
                'required' => false,
                'label' => 'Год закрытия',
                'choices' => $years,
            ))
            ->add('title', TextType::class, array(
                'required' => true,
                'label' => 'Название'
            ))
            ->add('category', ChoiceType::class, array(
                'required' => true,
                'label' => 'Категория',
                'choices' => MusicProject::getCategories()
            ))
            ->add('vocal', ChoiceType::class, array(
                'required' => false,
                'label' => 'Вокал',
                'choices' => MusicProject::getVocals()
            ))
            ->add('description', null, array(
                'required' => false,
                'label' => 'Описание'
            ))
//            ->add('mainImage')
            ->add('email', EmailType::class, array(
                'required' => false,
                'label' => 'Email'
            ))
            ->add('contactPhone')
            ->add('status', ChoiceType::class, array(
                'required' => true,
                'label' => 'Статус',
                'choices' => MusicProject::getStatuses()
            ))
            ->add('city')
            ->add('language')
            ->add('type')
            ->add('style')
            ->add('members')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MusicProject::class
        ));
    }
}
