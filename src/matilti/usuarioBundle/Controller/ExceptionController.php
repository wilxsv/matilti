<?php

namespace matilti\usuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\FlattenException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;


class ExceptionController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
 /**
  * Converts an Exception to a Response.
  *
  * @param FlattenException     $exception A FlattenException instance
  * @param DebugLoggerInterface $logger    A DebugLoggerInterface instance
  * @param string               $format    The format to use for rendering (html, xml, ...)
  * @param Boolean              $embedded  Whether the rendered Response will be embedded or not
  *
  * @throws \InvalidArgumentException When the exception template does not exist
  */
 public function exceptionAction(FlattenException $exception,DebugLoggerInterface $logger=null,$format='html', $embedded = false){
  return $this->render('usuarioBundle:Default:error.html.twig',
                array(
                    'exception' => $exception,
                )
        );
    }

}
