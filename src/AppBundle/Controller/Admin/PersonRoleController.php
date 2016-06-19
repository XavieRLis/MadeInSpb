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
 * @Route("/person-types", name="admin_person_type")
 */
class PersonRoleController extends CRUDController
{
    public function __construct()
    {
        $this->entityName = '\AppBundle\Entity\PersonRole';
        parent::__construct();
        $this->listFields = array(
            array(
                'fieldName' => 'title',
                'label' => 'Название'
            ),
        );
        $this->formType = '\AppBundle\Form\PersonRoleType';
    }
}
