<?php

namespace AppBundle\Form;

use AppBundle\Entity\Link;
use BW\Vkontakte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;

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
        $builder->get('url')
            ->addModelTransformer(new CallbackTransformer(
                function ($url) {
                    return $url;
                },
                function ($inputUrl) {
                    $vkAPI = new Vkontakte([
                        'client_id' => '5513448',
                        'client_secret' => 'ldSBVOfJVgP7VIRpcdEq',
                    ]);
                    if (strpos($inputUrl, 'vk.com')===false || preg_match('/public[0-9]+/', $inputUrl)==1) {
                        return $inputUrl;
                    }
                    $vkId = str_replace('http://vk.com/', '', $inputUrl);
                    $vkId = str_replace('https://vk.com/', '', $vkId);
                    $group = $vkAPI->api('groups.getById', [
                        'group_ids' => $vkId,
                        'lang' => 'ru'
                    ]);
                    // transform the string back to an array
                    return 'https://vk.com/public'.$group[0]['id'];
                }
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
