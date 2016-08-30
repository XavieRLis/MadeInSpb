<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class UserController
 * @package AppBundle\Controller\Admin
 * @Route("/people", name="person")
 */
class PersonController extends Controller
{
    /**
     * @Route("/")
     * @Method("GET")
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('AppBundle:Person')->findBy([],['lastName' => 'ASC']);
        return $this->render('People/index.html.twig', array(
            'entities' => $entities,
            'pageTitle' => 'Участники',
        ));
    }
}
