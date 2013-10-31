<?php

namespace matilti\usuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;


class DefaultController extends Controller{
 public function indexAction(){
  return $this->render('usuarioBundle:Default:login.html.twig');
 }
 
 public function loginAction(){
  if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
      $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
  } else { 
  	$error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR); 
  }
/*
  if (TRUE === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
        return $this->redirect('home');
  }
*/
  return $this->render('usuarioBundle:Default:login.html.twig', array(
  	            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
  	            'error' => $error
  	));
 }
 
 public function homeAction(){
	 return $this->render('usuarioBundle:Default:home.html.twig');
 }

 public function publicoAction(){
         $em = $this->getDoctrine()->getEntityManager();
         $entities = $em->getRepository('modeloBundle:ScdHistorialOperacion')->last5Oper();
         $request = Request::createFromGlobals();
         $page = FALSE;
         $project = FALSE;
         if ($request->getMethod()=='GET' && $request->query->get('page')){$page = $request->query->get('page');}
         if ($request->getMethod()=='GET' && $request->query->get('project')){$page = $request->query->get('project');}

	 return $this->render('usuarioBundle:Default:publico.html.twig', array('entities' => $entities, 'page' => $page, 'project' => $project));
 }
}

