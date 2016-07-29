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
use Symfony\Component\Form\Extension\Core\Type\UrlType;
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
                'label' => false,
                'choices' => $years,
                'placeholder' => 'Основание'
            ))
            ->add('endYear', ChoiceType::class, array(
                'required' => false,
                'label' => false,
                'choices' => $years,
                'placeholder' => 'Закрытие'
            ))
            ->add('title', TextType::class, array(
                'required' => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Название'
                ),
            ))
            ->add('category', ChoiceType::class, array(
                'required' => true,
                'label' => false,
                'choices' => MusicProject::getCategories()
            ))
            ->add('vocal', ChoiceType::class, array(
                'required' => false,
                'label' => false,
                'choices' => MusicProject::getVocals(),
                'placeholder' => 'Вокал'
            ))
            ->add('description', CKEditorType::class, array(
                'required' => false,
                'label' => 'Описание'
            ))
            ->add('imageFile', VichImageType::class, array('label' => false, 'required' => false,
                'download_link' => true))
            ->add('email', EmailType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Email'
                ),
            ))
            ->add('contactPhone', null, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Телефон'
                ),
            ))
            ->add('status', ChoiceType::class, array(
                'required' => true,
                'label' => false,
                'choices' => MusicProject::getStatuses(),
            ))
            ->add('city', null, array(
                'required' => false,
                'label' => false,
                'placeholder' => 'Город'
            ))
            ->add('languages', null, array(
                'required' => false,
                'label' => false,

            ))
            ->add('type', null, array(
                'required' => false,
                'label' => false,
                'placeholder' => 'Направление'
            ))
            ->add('style', null, array(
                'required' => false,
                'label' => false,

            ))
            ->add('links', CollectionType::class, array(
                'label' => 'Ссылки',
                'required' => false,
                'entry_type' => LinkType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ))
            ->add('members', CollectionType::class, array(
                'label' => 'Участники',
                'required' => false,
                'entry_type' => MusicProjectMemberType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
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
