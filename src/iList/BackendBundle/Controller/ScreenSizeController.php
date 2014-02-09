<?php

namespace iList\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use iList\BackendBundle\Entity\ScreenSize;
use iList\BackendBundle\Form\ScreenSizeType;

/**
 * ScreenSize controller.
 *
 */
class ScreenSizeController extends Controller
{

    /**
     * Lists all ScreenSize entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('iListBackendBundle:ScreenSize')->findAll();

        return $this->render('iListBackendBundle:ScreenSize:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ScreenSize entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ScreenSize();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('polegadas_show', array('id' => $entity->getId())));
        }

        return $this->render('iListBackendBundle:ScreenSize:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a ScreenSize entity.
    *
    * @param ScreenSize $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ScreenSize $entity)
    {
        $form = $this->createForm(new ScreenSizeType(), $entity, array(
            'action' => $this->generateUrl('polegadas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ScreenSize entity.
     *
     */
    public function newAction()
    {
        $entity = new ScreenSize();
        $form   = $this->createCreateForm($entity);

        return $this->render('iListBackendBundle:ScreenSize:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ScreenSize entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:ScreenSize')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScreenSize entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListBackendBundle:ScreenSize:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing ScreenSize entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:ScreenSize')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScreenSize entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListBackendBundle:ScreenSize:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ScreenSize entity.
    *
    * @param ScreenSize $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ScreenSize $entity)
    {
        $form = $this->createForm(new ScreenSizeType(), $entity, array(
            'action' => $this->generateUrl('polegadas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ScreenSize entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:ScreenSize')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScreenSize entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('polegadas_edit', array('id' => $id)));
        }

        return $this->render('iListBackendBundle:ScreenSize:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ScreenSize entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('iListBackendBundle:ScreenSize')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ScreenSize entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('polegadas'));
    }

    /**
     * Creates a form to delete a ScreenSize entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('polegadas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
