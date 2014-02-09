<?php

namespace iList\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use iList\BackendBundle\Entity\MemoryRam;
use iList\BackendBundle\Form\MemoryRamType;

/**
 * MemoryRam controller.
 *
 */
class MemoryRamController extends Controller
{

    /**
     * Lists all MemoryRam entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('iListBackendBundle:MemoryRam')->findAll();

        return $this->render('iListBackendBundle:MemoryRam:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new MemoryRam entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new MemoryRam();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('memoriaram_show', array('id' => $entity->getId())));
        }

        return $this->render('iListBackendBundle:MemoryRam:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a MemoryRam entity.
    *
    * @param MemoryRam $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(MemoryRam $entity)
    {
        $form = $this->createForm(new MemoryRamType(), $entity, array(
            'action' => $this->generateUrl('memoriaram_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new MemoryRam entity.
     *
     */
    public function newAction()
    {
        $entity = new MemoryRam();
        $form   = $this->createCreateForm($entity);

        return $this->render('iListBackendBundle:MemoryRam:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a MemoryRam entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:MemoryRam')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MemoryRam entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListBackendBundle:MemoryRam:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing MemoryRam entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:MemoryRam')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MemoryRam entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListBackendBundle:MemoryRam:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a MemoryRam entity.
    *
    * @param MemoryRam $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(MemoryRam $entity)
    {
        $form = $this->createForm(new MemoryRamType(), $entity, array(
            'action' => $this->generateUrl('memoriaram_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing MemoryRam entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:MemoryRam')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MemoryRam entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('memoriaram_edit', array('id' => $id)));
        }

        return $this->render('iListBackendBundle:MemoryRam:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a MemoryRam entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('iListBackendBundle:MemoryRam')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MemoryRam entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('memoriaram'));
    }

    /**
     * Creates a form to delete a MemoryRam entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('memoriaram_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
