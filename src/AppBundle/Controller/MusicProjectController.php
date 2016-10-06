<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MusicProject;
use AppBundle\Form\Filter\ProjectFilterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    public function indexAction(Request $request)
    {
        $form = $this->createForm(ProjectFilterType::class);

        $entities = $this->getDoctrine()->getRepository('AppBundle:MusicProject')->findBy(['status'=>MusicProject::STATUS_PUBLISHED], ['title' => 'ASC']);

        if ($request->query->has($form->getName())) {
            // manually bind values from the request
            $form->submit($request->query->get($form->getName()));

            // initialize a query builder
            $filterBuilder = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:MusicProject')
                ->createQueryBuilder('e')
                ->where('e.status = :status')
                ->setParameter('status', MusicProject::STATUS_PUBLISHED)
                ->orderBy('e.title', 'ASC');

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);
            $entities =$filterBuilder->getQuery()->getResult();
            // now look at the DQL =)

        }


        return $this->render('MusicProjects/index.html.twig', array(
            'entities' => $entities,
            'pageTitle' => 'Музыкальные проекты',
            'filterForm' => $form->createView()
        ));
    }
}
