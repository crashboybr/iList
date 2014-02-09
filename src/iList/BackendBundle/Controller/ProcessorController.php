<?php

namespace iList\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use iList\BackendBundle\Entity\Processor;
use iList\BackendBundle\Form\ProcessorType;

/**
 * Processor controller.
 *
 */
class ProcessorController extends Controller
{

    /**
     * Lists all Processor entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('iListBackendBundle:Processor')->findAll();

        return $this->render('iListBackendBundle:Processor:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Processor entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Processor();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('processadores_show', array('id' => $entity->getId())));
        }

        return $this->render('iListBackendBundle:Processor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Processor entity.
    *
    * @param Processor $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Processor $entity)
    {
        $form = $this->createForm(new ProcessorType(), $entity, array(
            'action' => $this->generateUrl('processadores_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Processor entity.
     *
     */
    public function newAction()
    {
        $entity = new Processor();
        $form   = $this->createCreateForm($entity);

        return $this->render('iListBackendBundle:Processor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Processor entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:Processor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Processor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListBackendBundle:Processor:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Processor entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:Processor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Processor entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListBackendBundle:Processor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Processor entity.
    *
    * @param Processor $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Processor $entity)
    {
        $form = $this->createForm(new ProcessorType(), $entity, array(
            'action' => $this->generateUrl('processadores_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Processor entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:Processor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Processor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('processadores_edit', array('id' => $id)));
        }

        return $this->render('iListBackendBundle:Processor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Processor entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('iListBackendBundle:Processor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Processor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('processadores'));
    }

    /**
     * Creates a form to delete a Processor entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('processadores_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
