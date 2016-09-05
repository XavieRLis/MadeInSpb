<?php

namespace AppBundle\Form\Filter;

use AppBundle\Entity\MusicProject;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type as Filters;

class ProjectFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'category',
                Filters\ChoiceFilterType::class,
                array(
                    'choices' => MusicProject::getCategories(),
                    'label' => 'Статус'
                )
            )
            ->add(
                'musicType',
                Filters\EntityFilterType::class,
                array(
                    'class'=> 'AppBundle\Entity\MusicType',
                    'label' => 'Направление'
                )
            )
            ->add(
                'endYear',
                Filters\ChoiceFilterType::class,
                array(
                    'choices' => ['Активные' => 0, 'Закрытые' => 1],
                    'apply_filter' => array($this, 'activeFieldCallback'),
                    'label' => 'Активность'
                )
            )
            ->add(
                'language',
                Filters\EntityFilterType::class,
                array(
                    'class'=> 'AppBundle\Entity\Language',
                    'label' => 'Язык'
                )
            )
            ->add(
                'style',
                Filters\EntityFilterType::class,
                array(
                    'class'=> 'AppBundle\Entity\Style',
                    'multiple'=> true,
                    'label' => 'Стили'

                )
            )
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }

    public function getBlockPrefix()
    {
        return 'project_filter';
    }

    public function activeFieldCallback(QueryInterface $filterQuery, $field, $values)
    {
        $expr = $filterQuery->getExpr();
        if ($values['value']==0) {
            return $filterQuery->createCondition($expr->isNull($field));
        }
        if ($values['value']==1) {
            return $filterQuery->createCondition($expr->isNotNull($field, null));
        }
        return null;
    }
}
