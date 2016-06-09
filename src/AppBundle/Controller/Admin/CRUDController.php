<?php
namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CRUDController extends BaseController
{
    protected $formClass;

    protected $entityName;

    protected $templateDirectory;

    protected $listFields;

    public function __construct()
    {
        $this->templateDirectory = 'Admin/Default/';
        $this->listFields = get_class_methods($this->entityName) ;
    }

    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository($this->entityName)->findAll();
        
        return $this->render($this->templateDirectory.'index.html.twig', array(
            'entities' => $entities,
            'fields' => $this->listFields
        ));
    }
}
