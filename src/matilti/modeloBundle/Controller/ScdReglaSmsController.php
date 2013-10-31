<?php

namespace matilti\modeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use matilti\modeloBundle\Entity\ScdReglaSms;
use matilti\modeloBundle\Form\ScdReglaSmsType;

use MakerLabs\PagerBundle\Pager;
use MakerLabs\PagerBundle\Adapter\DoctrineOrmAdapter;

/**
 * ScdReglaSms controller.
 *
 */
class ScdReglaSmsController extends Controller{
    /**
     * Lists all ScdReglaSms entities.
     *
     */
 public function indexAction($page=1){
  $request = Request::createFromGlobals();
  if ($request->getMethod()=='GET'){$page = $request->query->get('page');}
  $entity = new ScdReglaSms();
  $form   = $this->createForm(new ScdReglaSmsType(), $entity);
  return $this->render('modeloBundle:ScdReglaSms:index.html.twig', array(
   'form'   => $form->createView(),
   'pager' => $this->lista($page)
  ));
 }
    /**
     * Finds and displays a ScdReglaSms entity.
     *
     */
 public function showAction(){
  return $this->render('modeloBundle:ScdReglaSms:show.html.twig', array('pager' => $this->lista($page=999)));
 }

    /**
     * Displays a form to create a new ScdReglaSms entity.
     *
     */
 public function newAction(){
  if ($this->getRequest()->isXmlHttpRequest()){
   $entity = new ScdReglaSms();
   $form   = $this->createForm(new ScdReglaSmsType(), $entity);
   return $this->render('modeloBundle:ScdReglaSms:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
   ));
  }
 }
    /**
     * Creates a new ScdReglaSms entity.
     *
     */
 public function createAction(){
  if ($this->getRequest()->isXmlHttpRequest()){
   $entity  = new ScdReglaSms();
   $request = $this->getRequest();
   $form    = $this->createForm(new ScdReglaSmsType(), $entity);
   $form->bindRequest($request);
   if ($form->isValid()) {
	$em = $this->getDoctrine()->getEntityManager();
	$postt = $request->request->get("matilti_modelobundle_scdreglasmstype");
	$entity->setRegistroregla(new \DateTime('now'));
	//$entity->setFinregla(new \DateTime('now'));
	$em->persist($entity);
	$em->flush();
    return $this->redirect($this->generateUrl('admin_regla_show'));
   }
   return $this->render('modeloBundle:ScdReglaSms:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
    ));
  }
 }

    /**
     * Displays a form to edit an existing ScdReglaSms entity.
     *
     */
 public function editAction($id){
  if ($this->getRequest()->isXmlHttpRequest()){
   $em = $this->getDoctrine()->getEntityManager();
   $entity = $em->getRepository('modeloBundle:ScdReglaSms')->find($id);
   if (!$entity) { throw $this->createNotFoundException('Unable to find ScdReglaSms entity.'); }
   $editForm = $this->createForm(new ScdReglaSmsType(), $entity);
   return $this->render('modeloBundle:ScdReglaSms:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
  }
 }
    /**
     * Edits an existing ScdReglaSms entity.
     *
     */
 public function updateAction($id){
  if ($this->getRequest()->isXmlHttpRequest()){
   $em = $this->getDoctrine()->getEntityManager();
   $entity = $em->getRepository('modeloBundle:ScdReglaSms')->find($id);
   if (!$entity) { throw $this->createNotFoundException('Unable to find ScdReglaSms entity.'); }
   $editForm   = $this->createForm(new ScdReglaSmsType(), $entity);
   $request = $this->getRequest();
   $editForm->bindRequest($request);
   if ($editForm->isValid()) {
    $em->persist($entity);
    $em->flush();
    return $this->redirect($this->generateUrl('admin_regla_show'));
   }
   return $this->render('modeloBundle:ScdReglaSms:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
    ));
  }
 }
    /**
     * Deletes a ScdReglaSms entity.
     *
     */
 public function deleteAction($id){
  if ($this->getRequest()->isXmlHttpRequest()){
   $em = $this->getDoctrine()->getEntityManager();
   $entity = $em->getRepository('modeloBundle:ScdReglaSms')->find($id);
   if (!$entity) { throw $this->createNotFoundException('Unable to find ScdReglaSms entity.'); }
   $em->remove($entity);
   $em->flush();
   return $this->redirect($this->generateUrl('admin_regla_show'));
  }
 }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
  private function lista($page){
  $em = $this->getDoctrine()->getEntityManager();
  $qb = $em->getRepository('modeloBundle:ScdReglaSms')->createQueryBuilder('m');
  $adapter = new DoctrineOrmAdapter($qb);
  $pager = new Pager($adapter, array('page' => $page, 'limit' => 5));
  return $pager;
 }
}
