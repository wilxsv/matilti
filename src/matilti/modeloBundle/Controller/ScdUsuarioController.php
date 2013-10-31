<?php

namespace matilti\modeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

use matilti\modeloBundle\Entity\ScdUsuario;
use matilti\modeloBundle\Form\ScdUsuarioType;

use MakerLabs\PagerBundle\Pager;
use MakerLabs\PagerBundle\Adapter\DoctrineOrmAdapter;

/**
 * ScdUsuario controller.
 *
 */
class ScdUsuarioController extends Controller
{
    /**
     * Lists all ScdUsuario entities.
     *
     */
 public function indexAction($page=1){
  $request = Request::createFromGlobals();
  if ($request->getMethod()=='GET'){$page = $request->query->get('page');}
  $entity = new ScdUsuario();
  $form   = $this->createForm(new ScdUsuarioType(), $entity);
  return $this->render('modeloBundle:ScdUsuario:index.html.twig', array(
       'form'   => $form->createView(),
       'pager' => $this->lista($page)
    ));
 }

    /**
     * Finds and displays a ScdUsuario entity.
     *
     */
 public function showAction(){
  return $this->render('modeloBundle:ScdUsuario:show.html.twig', array( 'pager' => $this->lista($page=999) ));
 }

    /**
     * Displays a form to create a new ScdUsuario entity.
     *
     */
 public function newAction(){
  if ($this->getRequest()->isXmlHttpRequest()){
   $entity = new ScdUsuario();
   $form   = $this->createForm(new ScdUsuarioType(), $entity);
    return $this->render('modeloBundle:ScdUsuario:new.html.twig', array(
       'entity' => $entity,
       'form'   => $form->createView()
   ));
  }
 }
    /**
     * Creates a new ScdUsuario entity.
     *
     */
 public function createAction(){
  if ($this->getRequest()->isXmlHttpRequest()){
  $entity  = new ScdUsuario();
  $request = $this->getRequest();
  $form    = $this->createForm(new ScdUsuarioType(), $entity);
  $form->bindRequest($request);
  if ($form->isValid()) {
   $em = $this->getDoctrine()->getEntityManager();
   $entity->setSalt(md5(time()));
   $post = $request->request->get("matilti_modelobundle_scdusuariotype");
   $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
   $password = $encoder->encodePassword($post["password"], $entity->getSalt());
   $entity->setPassword($password);
   $entity->setUltimavisitausuario(new \DateTime('now'));
   $entity->setRegistrousuario(new \DateTime('now'));
   $entity->setIpusuario($this->getRequest()->getClientIp());
   $em->persist($entity);
   $em->flush();
   return $this->redirect($this->generateUrl('admin_usuario_show'));
  }
  return $this->render('modeloBundle:ScdUsuario:new.html.twig', array(
       'entity' => $entity,
       'form'   => $form->createView()
   ));
  }
 }

    /**
     * Displays a form to edit an existing ScdUsuario entity.
     *
     */
 public function editAction($id){
  if ($this->getRequest()->isXmlHttpRequest()){
   $em = $this->getDoctrine()->getEntityManager();
   $entity = $em->getRepository('modeloBundle:ScdUsuario')->find($id);
   if (!$entity) { throw $this->createNotFoundException('Unable to find ScdUsuario entity.'); }
   $editForm = $this->createForm(new ScdUsuarioType(), $entity);
   return $this->render('modeloBundle:ScdUsuario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
  }
 }

    /**
     * Edits an existing ScdUsuario entity.
     *
     */
 public function updateAction($id){
  if ($this->getRequest()->isXmlHttpRequest()){
   $em = $this->getDoctrine()->getEntityManager();
   $entity = $em->getRepository('modeloBundle:ScdUsuario')->find($id);
   if (!$entity) { throw $this->createNotFoundException('Unable to find ScdUsuario entity.'); }
   $editForm   = $this->createForm(new ScdUsuarioType(), $entity);
   $request = $this->getRequest();
   $editForm->bindRequest($request);
   if ($editForm->isValid()) {
	$entity->setSalt(md5(time()));
	$post = $request->request->get("matilti_modelobundle_scdusuariotype");
	$encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
	$password = $encoder->encodePassword($post["password"], $entity->getSalt());
	$entity->setPassword($password);
	$em->persist($entity);
	$em->flush();
	return $this->redirect($this->generateUrl('admin_usuario_show'));
   }
  }
 }

    /**
     * Deletes a ScdUsuario entity.
     *
     */
 public function deleteAction($id){
  if ($this->getRequest()->isXmlHttpRequest()){
   $em = $this->getDoctrine()->getEntityManager();
   $entity = $em->getRepository('modeloBundle:ScdUsuario')->find($id);
   if (!$entity) { throw $this->createNotFoundException('Unable to find ScdUsuario entity.'); }
   $em->remove($entity);
   $em->flush();
   return $this->redirect($this->generateUrl('admin_usuario_show'));
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
  $qb = $em->getRepository('modeloBundle:ScdUsuario')->createQueryBuilder('m');
  $adapter = new DoctrineOrmAdapter($qb);
  $pager = new Pager($adapter, array('page' => $page, 'limit' => 5));
  return $pager;
 }
}
