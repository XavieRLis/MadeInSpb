<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use \BW\Vkontakte as Vk;


class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $vk = new Vk([
            'client_id' => '5513448',
            'client_secret' => 'ldSBVOfJVgP7VIRpcdEq',
        ]);
        $builder
            ->add('firstName', TextType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Имя'
                ),
            ))
            ->add('lastName', TextType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Фамилия'
                ),
            ))
            ->add('vkId', TextType::class, array(
                'required' => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Ссылка на VK'
                ),
            ))
        ;
        $builder->get('vkId')
            ->addModelTransformer(new CallbackTransformer(
                function ($id) {
                    // transform the array to a string
                    return $id;
                },
                function ($idAsLink) use ($vk) {
                    // transform the string back to an array
                    $id = str_replace('http://vk.com/', '', $idAsLink);
                    $id = str_replace('https://vk.com/', '', $id);
                    $user = $vk->api('users.get', [
                        'user_ids' => $id,
                    ]);
                    return $user[0]['id'];
                }
            ))
        ;

    }

    public function getName()
    {
        return 'app_bundle_person_type';
    }
}
