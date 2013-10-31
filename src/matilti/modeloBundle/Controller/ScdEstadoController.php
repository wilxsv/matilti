<?php

namespace matilti\modeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use matilti\modeloBundle\Entity\ScdEstado;
use matilti\modeloBundle\Form\ScdEstadoType;

use MakerLabs\PagerBundle\Pager;
use MakerLabs\PagerBundle\Adapter\DoctrineOrmAdapter;

/**
 * ScdEstado controller.
 *
 */
class ScdEstadoController extends Controller{
 
 public function indexAction($page=1){
  $request = Request::createFromGlobals();
  if ($request->getMethod()=='GET'){$page = $request->query->get('page');}
  $entity = new ScdEstado();
  $form   = $this->createForm(new ScdEstadoType(), $entity);
  return $this->render('modeloBundle:ScdEstado:index.html.twig', array(
         'form'   => $form->createView(),
         'pager' => $this->lista($page)
      ));
 }

    /**
     * Finds and displays a ScdEstado entity.
     *
     */
 public function showAction(){
  return $this->render('modeloBundle:ScdEstado:show.html.twig', array('pager' => $this->lista($page=999)));
 }

    /**
     * Displays a form to create a new ScdEstado entity.
     *
     */
 public function newAction(){
  if ($this->getRequest()->isXmlHttpRequest()){
   $entity = new ScdEstado();
   $form   = $this->createForm(new ScdEstadoType(), $entity);
   return $this->render('modeloBundle:ScdEstado:new.html.twig', array(
         'entity' => $entity,
         'form'   => $form->createView()
     ));
  } else { throw new \Exception();}
 }

    /**
     * Creates a new ScdEstado entity.
     *
     */
 public function createAction(){
  if ($this->getRequest()->isXmlHttpRequest()){
   $entity  = new ScdEstado();
   $request = $this->getRequest();
   $form    = $this->createForm(new ScdEstadoType(), $entity);
   $form->bindRequest($request);
   if ($form->isValid()) {
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($entity);
    $em->flush();
    return $this->redirect($this->generateUrl('admin_estado_show'));
   }
   return $this->render('modeloBundle:ScdEstado:new.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView()
      ));
   }
 }

    /**
     * Displays a form to edit an existing ScdEstado entity.
     *
     */
 public function editAction($id){
  if ($this->getRequest()->isXmlHttpRequest()){
   $em = $this->getDoctrine()->getEntityManager();
   $entity = $em->getRepository('modeloBundle:ScdEstado')->find($id);
   if (!$entity) { throw $this->createNotFoundException('Unable to find ScdEstado entity.'); }
   $editForm = $this->createForm(new ScdEstadoType(), $entity);
   return $this->render('modeloBundle:ScdEstado:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
      ));
  }
 }

    /**
     * Edits an existing ScdEstado entity.
     *
     */
 public function updateAction($id){
  if ($this->getRequest()->isXmlHttpRequest()){
   $em = $this->getDoctrine()->getEntityManager();
   $entity = $em->getRepository('modeloBundle:ScdEstado')->find($id);
   if (!$entity) { throw $this->createNotFoundException('Unable to find ScdEstado entity.'); }
   $editForm   = $this->createForm(new ScdEstadoType(), $entity);
   $request = $this->getRequest();
   $editForm->bindRequest($request);
   if ($editForm->isValid()) {
	$em->persist($entity);
	$em->flush();
    return $this->redirect($this->generateUrl('admin_estado_show'));
   }
  }
   return $this->render('modeloBundle:ScdEstado:edit.html.twig', array(
         'entity'      => $entity,
         'edit_form'   => $editForm->createView(),
         'delete_form' => $deleteForm->createView(),
     ));
 }

    /**
     * Deletes a ScdEstado entity.
     *
     */
 public function deleteAction($id){
  if ($this->getRequest()->isXmlHttpRequest()){
   $em = $this->getDoctrine()->getEntityManager();
   $entity = $em->getRepository('modeloBundle:ScdEstado')->find($id);
   if (!$entity) { throw $this->createNotFoundException('Unable to find ScdEstado entity.'); }
   $em->remove($entity);
   $em->flush();
   return $this->redirect($this->generateUrl('admin_estado_show'));
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
  $qb = $em->getRepository('modeloBundle:ScdEstado')->createQueryBuilder('m');
  $adapter = new DoctrineOrmAdapter($qb);
  $pager = new Pager($adapter, array('page' => $page, 'limit' => 5));
  return $pager;
 }
}
