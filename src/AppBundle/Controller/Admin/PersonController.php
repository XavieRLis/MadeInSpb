<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class UserController
 * @package AppBundle\Controller\Admin
 * @Route("/people", name="admin_person")
 */
class PersonController extends CRUDController
{
    public function __construct()
    {
        $this->entityName = '\AppBundle\Entity\Person';
        parent::__construct();
        $this->listFields = array(
            array(
                'fieldName' => 'name',
                'label' => 'ФИО'
            ),
            array(
                'fieldName' => 'vkId',
                'label' => 'Ссылка VK'
            ),            
        );
        $this->formType = '\AppBundle\Form\PersonType';
    }
}
