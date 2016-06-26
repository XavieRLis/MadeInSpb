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
 * Class LinkTypeController
 * @package AppBundle\Controller\Admin
 * @Route("/link-type", name="admin_link_type")
 */
class LinkTypeController extends CRUDController
{
    public function __construct()
    {
        $this->entityName = '\AppBundle\Entity\LinkType';
        parent::__construct();
        $this->listFields = array(
            array(
                'fieldName' => 'name',
                'label' => 'Название'
            ),
        );
        $this->formType = '\AppBundle\Form\LinkTypeType';
    }
}
