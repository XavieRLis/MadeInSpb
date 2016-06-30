<?php

namespace AppBundle\Form;

use AppBundle\Entity\MusicProject;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            ->add('description', CKEditorType::class, array(
                'required' => false,
                'label' => 'Описание'
            ))
            ->add('imageFile', VichImageType::class, array('label' => false, 'required' => false,
                'download_link' => true))
            ->add('email', EmailType::class, array(
                'required' => false,
                'label' => 'Email'
            ))
            ->add('contactPhone', null, array(
                'required' => false,
                'label' => 'телефон'
            ))
            ->add('status', ChoiceType::class, array(
                'required' => true,
                'label' => 'Статус',
                'choices' => MusicProject::getStatuses()
            ))
            ->add('city', null, array(
                'required' => false,
                'label' => 'Город'
            ))
            ->add('language', null, array(
                'required' => false,
                'label' => 'Город'
            ))
            ->add('type', null, array(
                'required' => false,
                'label' => 'Направление'
            ))
            ->add('style', null, array(
                'required' => false,
                'label' => 'Стили',

            ))
            ->add('members', null, array(
                'required' => false,
                'label' => 'Участники'
            ))
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
