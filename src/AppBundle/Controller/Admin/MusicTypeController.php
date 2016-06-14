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
 * @Route("/music_type", name="admin_music_type")
 */
class MusicTypeController extends CRUDController
{
    public function __construct()
    {
        $this->entityName = '\AppBundle\Entity\MusicType';
        parent::__construct();
        $this->listFields = array(
            array(
                'fieldName' => 'name',
                'label' => 'Название'
            ),
        );
        $this->formType = '\AppBundle\Form\MusicTypeType';
    }
}
