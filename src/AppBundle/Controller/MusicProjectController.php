<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class UserController
 * @package AppBundle\Controller
 * @Route("/music-project", name="music_project")
 */
class MusicProjectController extends Controller
{
    /**
     * @Route("/")
     * @Method("GET")
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository('AppBundle:MusicProject')->findAll();
        return $this->render('MusicProjects/index.html.twig', array(
            'entities' => $entities,
            'pageTitle' => 'Музыкальные проекты',
        ));
    }
}
