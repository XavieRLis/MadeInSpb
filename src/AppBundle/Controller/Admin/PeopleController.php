<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 09.06.2016
 * Time: 22:23
 */

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class UserController
 * @package AppBundle\Controller\Admin
 * @Route("/people", name="admin_people")
 */
class PeopleController extends CRUDController
{
    public function __construct()
    {
        $this->entityName = '\AppBundle\Entity\People';
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
            array(
                'fieldName' => 'role',
                'label' => 'Роль'
            ),
        );
        $this->formType = '\AppBundle\Form\PeopleType';
    }
}
