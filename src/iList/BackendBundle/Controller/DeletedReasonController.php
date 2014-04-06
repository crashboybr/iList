<?php

namespace iList\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use iList\BackendBundle\Entity\DeletedReason;
use iList\BackendBundle\Form\DeletedReasonType;

/**
 * DeletedReason controller.
 *
 */
class DeletedReasonController extends Controller
{

    /**
     * Lists all DeletedReason entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('iListBackendBundle:DeletedReason')->findAll();

        return $this->render('iListBackendBundle:DeletedReason:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new DeletedReason entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new DeletedReason();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('deletedreason_show', array('id' => $entity->getId())));
        }

        return $this->render('iListBackendBundle:DeletedReason:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a DeletedReason entity.
    *
    * @param DeletedReason $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(DeletedReason $entity)
    {
        $form = $this->createForm(new DeletedReasonType(), $entity, array(
            'action' => $this->generateUrl('deletedreason_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new DeletedReason entity.
     *
     */
    public function newAction()
    {
        $entity = new DeletedReason();
        $form   = $this->createCreateForm($entity);

        return $this->render('iListBackendBundle:DeletedReason:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a DeletedReason entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:DeletedReason')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DeletedReason entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListBackendBundle:DeletedReason:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing DeletedReason entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:DeletedReason')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DeletedReason entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListBackendBundle:DeletedReason:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a DeletedReason entity.
    *
    * @param DeletedReason $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(DeletedReason $entity)
    {
        $form = $this->createForm(new DeletedReasonType(), $entity, array(
            'action' => $this->generateUrl('deletedreason_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing DeletedReason entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:DeletedReason')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DeletedReason entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('deletedreason_edit', array('id' => $id)));
        }

        return $this->render('iListBackendBundle:DeletedReason:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a DeletedReason entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('iListBackendBundle:DeletedReason')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DeletedReason entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('deletedreason'));
    }

    /**
     * Creates a form to delete a DeletedReason entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('deletedreason_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
