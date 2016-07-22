<?php
namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CRUDController extends BaseController
{
    protected $formClass;

    protected $entityName;

    protected $templateDirectory;

    protected $listFields;
    protected $pageTitle;

    protected $formType;

    public function __construct()
    {
        $this->templateDirectory = 'Admin/Default/';
        $this->listFields = get_class_methods($this->entityName);
        $this->pageTitle = $this->getClassName();
        $this->formType = null;
    }

    /**
     * @Route("/")
     * @Method("GET")
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository($this->entityName)->findAll();
        $form = $this->getForm();
        return $this->render($this->templateDirectory.'index.html.twig', array(
            'entities' => $entities,
            'fields' => $this->listFields,
            'pageTitle' => $this->pageTitle,
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @Route("/new")
     * @Method({"GET","HEAD","POST"})
     * @return Response
     */
    public function createAction(Request $request)
    {
        $entity = new $this->entityName;

        $form = $this->getForm($entity);
        $form->handleRequest($request);
        $manager = $this->getDoctrine()->getEntityManager();

        if ($form->isValid()) {
            $manager->persist($entity);
            $manager->flush($entity);
            return $this->redirect($request->getPathInfo());
        }
        
        return $this->render($this->templateDirectory.'form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param $entityId
     * @Route("/edit/{entityId}")
     * @Method({"GET", "POST"})
     * @return Response
     */
    public function updateAction(Request $request, $entityId)
    {
        $entity = $this->getDoctrine()->getRepository($this->entityName)->find($entityId);
        $form = $this->getForm($entity, 'edit/'.$entityId);
        $form->handleRequest($request);
        $manager = $this->getDoctrine()->getEntityManager();

        if ($form->isValid()) {
            $manager->persist($entity);
            $manager->flush($entity);
            return $this->redirect($request->getPathInfo());
        }

        return $this->render(':Admin/Default:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param $entityId
     * @Route("/delete/{entityId}")
     * @Method({"GET", "POST"})
     * @return Response
     */
    public function deleteAction(Request $request, $entityId)
    {
        $entity = $this->getDoctrine()->getRepository($this->entityName)->find($entityId);

        $form = $this->getDeleteForm($entityId);
        $manager = $this->getDoctrine()->getEntityManager();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $manager->remove($entity);
            $manager->flush();
            return $this->redirect($request->getPathInfo());
        }

        return $this->render(':Admin/Default:delete_form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    protected function getForm($entity = null, $action = 'new')
    {
        if ($this->formType === null) {
            return null;
        }
        if ($entity === null) {
            $entity = new $this->entityName;
        }
        $options = array(
            'method' => 'POST',
            'action' => $action
        );
        return $this->createForm($this->formType, $entity, $options);
    }

    protected function getDeleteForm($entityId)
    {
        return $this->createFormBuilder()->setAction('delete/'.$entityId)->getForm();
    }


    public function getClassName()
    {
        return array(
            'namespace' => array_slice(explode('\\', $this->entityName), 0, -1),
            'classname' => join('', array_slice(explode('\\', $this->entityName), -1)),
        );
    }
}
