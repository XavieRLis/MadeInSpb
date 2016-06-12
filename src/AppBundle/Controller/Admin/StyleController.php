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
 * @Route("/style", name="admin_style")
 */
class StyleController extends CRUDController
{
    public function __construct()
    {
        $this->entityName = '\AppBundle\Entity\Style';
        parent::__construct();
        $this->listFields = array(
            array(
                'fieldName' => 'name',
                'label' => 'Название'
            ),
        );
        $this->formType = '\AppBundle\Form\StyleType';
    }
}
