<?php

namespace iList\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use iList\BackendBundle\Entity\AdQueue;
use iList\BackendBundle\Form\AdQueueType;
use iList\BackendBundle\Entity\DeclinedAds;

/**
 * AdQueue controller.
 *
 */
class AdQueueController extends Controller
{

    /**
     * Lists all AdQueue entities.
     *
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == "POST")
        {
            $approve = $request->get('approve');
            $reason_id = $request->get('reason');
            $ad_id = $request->get('ad_id');

            $ad = $em->getRepository('iListBackendBundle:Ad')->find($ad_id);
            $ad->setStatus($approve);

            $em->persist($ad);
            $em->flush();
            if (!$approve)
            {
                $declined_msg = $em->getRepository('iListBackendBundle:DeclinedMsg')->find($reason_id);
                $declined_ad = new DeclinedAds();
                $declined_ad->setAd($ad);
                $declined_ad->setDeclinedMsg($declined_msg);
                $em->persist($declined_ad);
                $em->flush();

                $this->get('send_mail')->sendEmail($ad->getUser()->getEmail(), 'Seu anuncio foi recusado', 'Revisao');
            }
            else
            {
                $this->get('send_mail')->sendEmail($ad->getUser()->getEmail(), 'Seu anuncio foi aprovado', 'Revisao');
            }
            //echo "<pre>";
            //\Doctrine\Common\Util\Debug::dump($declined_ad);exit;
        }

        $ad = $em->getRepository('iListBackendBundle:Ad')->findOneBy(
            array('status' => -1), array('createdAt' => 'ASC'));

        $declined_msgs = $em->getRepository('iListBackendBundle:DeclinedMsg')->findAll();


        return $this->render('iListBackendBundle:AdQueue:index.html.twig', array(
            'ad' => $ad,
            'declined_msgs' => $declined_msgs
        ));
    }
    /**
     * Creates a new AdQueue entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new AdQueue();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fila_show', array('id' => $entity->getId())));
        }

        return $this->render('iListBackendBundle:AdQueue:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a AdQueue entity.
    *
    * @param AdQueue $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(AdQueue $entity)
    {
        $form = $this->createForm(new AdQueueType(), $entity, array(
            'action' => $this->generateUrl('fila_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AdQueue entity.
     *
     */
    public function newAction()
    {
        $entity = new AdQueue();
        $form   = $this->createCreateForm($entity);

        return $this->render('iListBackendBundle:AdQueue:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AdQueue entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:AdQueue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AdQueue entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListBackendBundle:AdQueue:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing AdQueue entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:AdQueue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AdQueue entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListBackendBundle:AdQueue:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a AdQueue entity.
    *
    * @param AdQueue $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AdQueue $entity)
    {
        $form = $this->createForm(new AdQueueType(), $entity, array(
            'action' => $this->generateUrl('fila_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AdQueue entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:AdQueue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AdQueue entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('fila_edit', array('id' => $id)));
        }

        return $this->render('iListBackendBundle:AdQueue:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a AdQueue entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('iListBackendBundle:AdQueue')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AdQueue entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fila'));
    }

    /**
     * Creates a form to delete a AdQueue entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fila_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
