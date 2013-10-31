<?php

namespace matilti\modeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use matilti\modeloBundle\Entity\ScdEntidad;
use matilti\modeloBundle\Form\ScdEntidadType;

use MakerLabs\PagerBundle\Pager;
use MakerLabs\PagerBundle\Adapter\DoctrineOrmAdapter;

/**
 * ScdEntidad controller.
 *
 */
class ScdEntidadController extends Controller{
 public function indexAction($page=1){
  $request = Request::createFromGlobals();
  if ($request->getMethod()=='GET'){$page = $request->query->get('page');}
  $entity = new ScdEntidad();
  $form   = $this->createForm(new ScdEntidadType(), $entity);
  $em = $this->getDoctrine()->getEntityManager();
  $entities = $em->getRepository('modeloBundle:ScdEntidad')->findAll();
  return $this->render('modeloBundle:ScdEntidad:index.html.twig', array(
         'entities' => $entities,
         'form'   => $form->createView(),
         'pager' => $this->lista($page)
      ));
 }

 public function showAction(){
 // if ($this->getRequest()->isXmlHttpRequest()){
   $em = $this->getDoctrine()->getEntityManager();
   $entity = $em->getRepository('modeloBundle:ScdEntidad')->findAll();
   return $this->render('modeloBundle:ScdEntidad:show.html.twig', array('pager' => $this->lista($page=999)));
 // }
 }

 public function newAction(){
  if ($this->getRequest()->isXmlHttpRequest()){
   $entity = new ScdEntidad();
   $form   = $this->createForm(new ScdEntidadType(), $entity);
   return $this->render('modeloBundle:ScdEntidad:new.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView()
     ));
  } //else return error
 }

 public function createAction(){
  if ($this->getRequest()->isXmlHttpRequest()){
   $entity  = new ScdEntidad();
   $request = $this->getRequest();
   $form    = $this->createForm(new ScdEntidadType(), $entity);
   $form->bindRequest($request);
   if ($form->isValid()) {
    $em = $this->getDoctrine()->getEntityManager();
    $em->persist($entity);
    $em->flush();
    return $this->redirect($this->generateUrl('admin_entidad_show'));
   }
   return $this->render('modeloBundle:ScdEntidad:new.html.twig', array(
          'entity' => $entity,
          'form'   => $form->createView()
      ));
  }
 }

 public function editAction($id){
  if ($this->getRequest()->isXmlHttpRequest()){
   $em = $this->getDoctrine()->getEntityManager();
   $entity = $em->getRepository('modeloBundle:ScdEntidad')->find($id);
   if (!$entity) { throw $this->createNotFoundException('Unable to find ScdEntidad entity.'); }
   $editForm = $this->createForm(new ScdEntidadType(), $entity);
   $deleteForm = $this->createDeleteForm($id);
   return $this->render('modeloBundle:ScdEntidad:edit.html.twig', array(
          'entity'      => $entity,
          'edit_form'   => $editForm->createView(),
          'delete_form' => $deleteForm->createView(),
    ));
  }
 }

 public function updateAction($id){
  if ($this->getRequest()->isXmlHttpRequest()){
   $em = $this->getDoctrine()->getEntityManager();
   $entity = $em->getRepository('modeloBundle:ScdEntidad')->find($id);
   if (!$entity) { throw $this->createNotFoundException('Unable to find ScdEntidad entity.'); }
   $editForm   = $this->createForm(new ScdEntidadType(), $entity);
   $deleteForm = $this->createDeleteForm($id);
   $request = $this->getRequest();
   $editForm->bindRequest($request);
   if ($editForm->isValid()) {
    $em->persist($entity);
    $em->flush();
    return $this->redirect($this->generateUrl('admin_entidad_show'));
   }
   return $this->render('modeloBundle:ScdEntidad:edit.html.twig', array(
         'entity'      => $entity,
         'edit_form'   => $editForm->createView(),
         'delete_form' => $deleteForm->createView(),
    ));
  }
 }

 public function deleteAction($id){
  if ($this->getRequest()->isXmlHttpRequest()){
   $em = $this->getDoctrine()->getEntityManager();
   $entity = $em->getRepository('modeloBundle:ScdEntidad')->find($id);
   if (!$entity) { throw $this->createNotFoundException('Unable to find ScdEntidad entity.'); }
   $em->remove($entity);
   $em->flush();
   return $this->redirect($this->generateUrl('admin_entidad_show'));
  }
 }

 private function createDeleteForm($id){
  return $this->createFormBuilder(array('id' => $id))
         ->add('id', 'hidden')
         ->getForm();
 }

 private function lista($page){
  $em = $this->getDoctrine()->getEntityManager();
  $qb = $em->getRepository('modeloBundle:ScdEntidad')->createQueryBuilder('m');
  $adapter = new DoctrineOrmAdapter($qb);
  $pager = new Pager($adapter, array('page' => $page, 'limit' => 5));
  return $pager;
 }
}
