<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="avanzu_admin_home")
     */
    public function indexAction()
    {
        return $this->render('::admin.html.twig');
    }
}
