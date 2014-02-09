<?php

namespace iList\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use iList\BackendBundle\Entity\Ad;
use iList\BackendBundle\Entity\AdMsg;
use iList\BackendBundle\Entity\AdImage;
use iList\BackendBundle\Form\AdType;
use iList\BackendBundle\Form\AdMsgType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Ad controller.
 *
 */
class AdController extends Controller
{

    /**
     * Lists all Ad entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('iListBackendBundle:Ad')->findAll();

        return $this->render('iListFrontendBundle:Ad:index.html.twig', array(
            'entities' => $entities,
        ));
    }


    public function viewAdAction($city, $category_name, $slug, $state, $id)
    {


        $em = $this->getDoctrine()->getManager();   

        $category = $em->getRepository('iListBackendBundle:Category')
            ->findOneBy(array('name' => $category_name));

        $ad = $em->getRepository('iListBackendBundle:Ad')
            ->findOneBy(array('category' => $category, 'city' => $city, 'slug' => $slug, 'state' => $state, 'id' => $id));
        
        if (!$ad)
            throw $this->createNotFoundException('Oops! Não encontramos este anúncio! :(');

        $entity = new AdMsg();
        $entity->setAd($ad);
        $form   = $this->createAdMsgForm($entity);

        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($this->getUser());exit;
    

        return $this->render('iListFrontendBundle:Ad:viewAd.html.twig', array(
            'ad' => $ad, 
            'form' => $form->createView()
            ));
    }



    public function getByCategoryIdAction()
    {
        $this->em = $this->get('doctrine')->getEntityManager();
        $this->repository = $this->em->getRepository('iListBackendBundle:SubCategory');
     
        $categoryId = $this->get('request')->query->get('data');

        
     
        $subcategories = $this->repository->findByCategory($categoryId);
        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($subcategories);exit;
     
        $html = '';
        foreach($subcategories as $subcategory)
        {
            $html = $html . sprintf("<option value=\"%d\">%s</option>",$subcategory->getId(), $subcategory->getName());
        }
     
        return new Response($html);
    }

    /*
    public function getBySubCategoryIdAction()
    {
        $this->em = $this->get('doctrine')->getEntityManager();
        $this->repository = $this->em->getRepository('iListBackendBundle:Product');
     
        $subcategoryId = $this->get('request')->query->get('data');

        
     
        $products = $this->repository->findByCategory($subcategoryId);
        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($products);exit;
     
        $html = '';
        foreach($products as $product)
        {
            $html = $html . sprintf("<option value=\"%d\">%s</option>",$product->getId(), $product->getName());
        }
     
        return new Response($html);
    }
*/
    /**
     * Creates a new Ad entity.
     *
     */
  

    public function sendAdMsgAction(Request $request)
    {

        $entity = new AdMsg();
        
        $form = $this->createAdMsgForm($entity);
        
        $form->handleRequest($request);

        
        //var_dump($form->isValid());exit;

        $ad = $form->getData()->getAd();
        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($form->getData()->getAd());exit;
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $user = $this->getUser();

            if ($user)
                $entity->setFromUser($user);


            
            $entity->setTitle("Nova Mensagem - Anúncio: " . $ad->getTitle());
            $entity->setStatus(-1); //nao lido

            $toUser = $ad->getUser();
            $entity->setToUser($toUser);
            //echo "<pre>";
            //\Doctrine\Common\Util\Debug::dump($ad->getUser();exit;
            $em->persist($entity);
            $em->flush($entity);

            $this->get('session')->getFlashBag()->add(
            'notice',
            'Mensagem enviada com sucesso!');

            return $this->redirect($this->generateUrl('subdomain_vi', 
                array(
                    'city' => $ad->getCity(),
                    'category_name' => strtolower($ad->getCategory()),
                    'slug' => $ad->getSlug(),
                    'state' => $ad->getState(),
                    'id' => $ad->getId()
                    
                    )
                ));
            



        }
 
        return $this->render('iListFrontendBundle:Ad:viewAd.html.twig', array(
            'ad' => $ad, 
            'form' => $form->createView()
            ));
    }

    /**
     * Creates a new Ad entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Ad();
        
        $form = $this->createCreateForm($entity);
        
        $form->handleRequest($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $user = $this->get('security.context')->getToken()->getUser();
            
            $entity->setUser($user);
            $entity->setStatus(-1); //revisao
            $entity->setSlug($entity->getTitle());
            //var_dump($entity->getSlug());exit;    
            //echo "<pre>";
            //\Doctrine\Common\Util\Debug::dump($entity);exit;
            
            $i = 1;
            $date = date('Y-m-d H:i:s');
            foreach ($entity->getAdImages() as $adImage)
            {
                
                $entity->setDefaultImg('indo');
                $adImage->setAds($entity);
                $adImage->setPosition($i++);
                $file = $adImage->getPic();
                $adImage->setPic(null);
                $adImage->setFile($file);
                
                
                //$adImage->setCreatedAt(new \DateTime($date));
                //$adImage->setUpdatedAt(new \DateTime($date));

              
                
               
                //$em->persist($adImage);
                //$em->flush();
                

            }
            //exit;

             


            $em->persist($entity);
            $em->flush();

            
            $img = $entity->getAdImages();
            if ($img) 
            {
                $entity->setDefaultImg($img[0]->getPic());
                $em->persist($entity);
                $em->flush();
            }
           
            


            

            return $this->render('iListFrontendBundle:Ad:review.html.twig');
        }

        return $this->render('iListFrontendBundle:Ad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Ad entity.
    *
    * @param Ad $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Ad $entity)
    {

        $ad_image = new AdImage();
        $entity->addAdImage($ad_image);

        $ad_image = new AdImage();
        $entity->addAdImage($ad_image);

        $ad_image = new AdImage();
        $entity->addAdImage($ad_image);

        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($entity);exit;


        $form = $this->createForm(new AdType(), $entity, array(
            'action' => $this->generateUrl('anuncio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    private function createAdMsgForm(AdMsg $entity)
    {

        $form = $this->createForm(new AdMsgType(), $entity, array(
            'action' => $this->generateUrl('ad_msg_send'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Enviar Email'));

        return $form;
    }

    /**
     * Displays a form to create a new Ad entity.
     *
     */
    public function newAction()
    {
        $entity = new Ad();
        
        $form   = $this->createCreateForm($entity);

        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($form);exit;

        return $this->render('iListFrontendBundle:Ad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Ad entity.
     *
     */
    public function newWizardAction()
    {
        $entity = new Ad();
        $form   = $this->createCreateForm($entity);
        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($form);exit;

        return $this->render('iListFrontendBundle:Ad:new_wizard.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Finds and displays a Ad entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:Ad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListFrontendBundle:Ad:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Ad entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:Ad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ad entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListFrontendBundle:Ad:new.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Ad entity.
    *
    * @param Ad $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Ad $entity)
    {
        $form = $this->createForm(new AdType(), $entity, array(
            'action' => $this->generateUrl('anuncio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Ad entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:Ad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
            $entity->setStatus(-1); //revisao
            $entity->setSlug($entity->getTitle());

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('anuncio_edit', array('id' => $id)));
        }

        return $this->render('iListFrontendBundle:Ad:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Ad entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('iListBackendBundle:Ad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('anuncio'));
    }

    /**
     * Creates a form to delete a Ad entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('anuncio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
