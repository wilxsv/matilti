<?php

namespace matilti\modeloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use matilti\modeloBundle\Entity\ScdDenuncia;
use matilti\modeloBundle\Form\ScdDenunciaType;

/**
 * ScdDenuncia controller.
 *
 */
class ScdDenunciaController extends Controller
{
    /**
     * Lists all ScdDenuncia entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('modeloBundle:ScdDenuncia')->findAll();

        return $this->render('modeloBundle:ScdDenuncia:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a ScdDenuncia entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('modeloBundle:ScdDenuncia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScdDenuncia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('modeloBundle:ScdDenuncia:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new ScdDenuncia entity.
     *
     */
    public function newAction()
    {
        $entity = new ScdDenuncia();
        $form   = $this->createForm(new ScdDenunciaType(), $entity);

        return $this->render('modeloBundle:ScdDenuncia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new ScdDenuncia entity.
     *
     */
    public function createAction()
    {
        $entity  = new ScdDenuncia();
        $request = $this->getRequest();
        $form    = $this->createForm(new ScdDenunciaType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_show', array('id' => $entity->getId())));
            
        }

        return $this->render('modeloBundle:ScdDenuncia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing ScdDenuncia entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('modeloBundle:ScdDenuncia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScdDenuncia entity.');
        }

        $editForm = $this->createForm(new ScdDenunciaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('modeloBundle:ScdDenuncia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing ScdDenuncia entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('modeloBundle:ScdDenuncia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScdDenuncia entity.');
        }

        $editForm   = $this->createForm(new ScdDenunciaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_edit', array('id' => $id)));
        }

        return $this->render('modeloBundle:ScdDenuncia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ScdDenuncia entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('modeloBundle:ScdDenuncia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ScdDenuncia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
