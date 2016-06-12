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
 * @Route("/user", name="admin_user")
 */
class UserController extends CRUDController
{
    public function __construct()
    {
        $this->entityName = '\AppBundle\Entity\User';
        parent::__construct();
        $this->listFields = array(
            array(
                'fieldName' => 'name',
                'label' => 'ФИО'
            ),
            array(
                'fieldName' => 'username',
                'label' => 'Имя пользователя'
            ),
        );
        $this->formType = '\AppBundle\Form\UserType';
    }
}
