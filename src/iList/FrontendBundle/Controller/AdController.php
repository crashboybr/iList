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
use iList\BackendBundle\Entity\Category;
use iList\FrontendBundle\Form\DeletedReasonType;

use iList\BackendBundle\Form\NewAdType;

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


    public function viewAdAction($city, $category_name, $slug, $state)
    {


        $em = $this->getDoctrine()->getManager();   

        $category = $em->getRepository('iListBackendBundle:Category')
            ->findOneBy(array('name' => $category_name));
        //$city = str_replace("-", " ", $city);

        $ad = $em->getRepository('iListBackendBundle:Ad')
            ->findOneBy(array('status' => 1, 'category' => $category, 'city_slug' => $city, 'slug' => $slug, 'state' => $state));
        
        if (!$ad)
            throw $this->createNotFoundException('Oops! Não encontramos este anúncio! :(');

        $entity = new AdMsg();
        $entity->setAd($ad);
        $form   = $this->createAdMsgForm($entity);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        // Simple example
        $breadcrumbs->addItem("Home", $this->get("router")->generate("home"));
        $breadcrumbs->addItem(strtoupper($state), $this->get("router")->generate("subdomain_search", array('state' => $state)));
        $breadcrumbs->addItem($category->getName(), $this->get("router")->generate("subdomain_search", array('state' => $state, 'category_name' => $category_name)));
        $breadcrumbs->addItem($category->getName() . " " . $ad->getSubcategory(), $this->get("router")->generate("brasil_search"));

        //path('subdomain_search', {'state': state, 'category_name': 'iphone' })

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
        $category_repo = $this->em->getRepository('iListBackendBundle:Category');
     
        $categoryId = $this->get('request')->query->get('data');


        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($category);exit;
     
        $subcategories = $this->repository->findByCategory($categoryId);
        
        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($category);exit;
        

        $html = '';

        foreach($subcategories as $subcategory)
        {
            $html = $html . sprintf("<option value=\"%d\">%s</option>",$subcategory->getId(), $subcategory->getName());

        }

        //if ($html)
            //$html = sprintf("<option value=\"%d\">%s</option>","", "Escolha o Modelo") . $html;

        return new Response($html);
    }

    public function getColorByCategoryIdAction()
    {
        $this->em = $this->get('doctrine')->getEntityManager();
        //$this->repository = $this->em->getRepository('iListBackendBundle:Color');
        $category_repo = $this->em->getRepository('iListBackendBundle:Category');
     
        $categoryId = $this->get('request')->query->get('data');

        $category = $category_repo->findOneById($categoryId);

        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($category);exit;
     

        $colors = $category->getColors();

        
        $html = '';


        foreach ($colors as $color)
        {
            $html = $html . sprintf("<option value=\"%d\">%s</option>",$color->getId(), $color->getName());
        }
        
        if ($html)
            $html = sprintf("<option value=\"%d\">%s</option>","", "Escolha a Cor") . $html;

        return new Response($html);
    }


    public function getSizeByCategoryIdAction()
    {
        $this->em = $this->get('doctrine')->getEntityManager();
        //$this->repository = $this->em->getRepository('iListBackendBundle:Color');
        $category_repo = $this->em->getRepository('iListBackendBundle:Category');
     
        $categoryId = $this->get('request')->query->get('data');

        $category = $category_repo->findOneById($categoryId);

        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($category);exit;
     

        $sizes = $category->getSizes();

        
        $html = '';

        

        foreach ($sizes as $size)
        {
            $html = $html . sprintf("<option value=\"%d\">%s</option>",$size->getId(), $size->getSize());
        }
        
        if ($html)
            $html = sprintf("<option value=\"%d\">%s</option>","", "Escolha a Capacidade") . $html;


        return new Response($html);
    }

    public function getMemoryByCategoryIdAction()
    {
        $this->em = $this->get('doctrine')->getEntityManager();
        //$this->repository = $this->em->getRepository('iListBackendBundle:Color');
        $category_repo = $this->em->getRepository('iListBackendBundle:Category');
     
        $categoryId = $this->get('request')->query->get('data');

        $category = $category_repo->findOneById($categoryId);

        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($category);exit;
     

        $memorys = $category->getMemories();

        
        $html = '';

        foreach ($memorys as $memory)
        {
            $html = $html . sprintf("<option value=\"%d\">%s</option>",$memory->getId(), $memory->getName());
        }

        if ($html)
            $html = sprintf("<option value=\"%d\">%s</option>","", "Escolha a Memória") . $html;

        //var_dump($html);exit;
        return new Response($html);
    }

    public function getScreenByCategoryIdAction()
    {
        $this->em = $this->get('doctrine')->getEntityManager();
        //$this->repository = $this->em->getRepository('iListBackendBundle:Color');
        $category_repo = $this->em->getRepository('iListBackendBundle:Category');
     
        $categoryId = $this->get('request')->query->get('data');

        $category = $category_repo->findOneById($categoryId);

        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($category);exit;
     

        $screens = $category->getScreens();

        
        $html = '';

        foreach ($screens as $screen)
        {
            $html = $html . sprintf("<option value=\"%d\">%s</option>",$screen->getId(), $screen->getSize());
        }
        if ($html)
            $html = sprintf("<option value=\"%d\">%s</option>","", "Escolha a Tela") . $html;
        
        return new Response($html);
    }

    public function getProcessorByCategoryIdAction()
    {
        $this->em = $this->get('doctrine')->getEntityManager();
        //$this->repository = $this->em->getRepository('iListBackendBundle:Color');
        $category_repo = $this->em->getRepository('iListBackendBundle:Category');
     
        $categoryId = $this->get('request')->query->get('data');

        $category = $category_repo->findOneById($categoryId);

        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($category);exit;
     

        $processors = $category->getProcessors();

        
        $html = '';


        

        foreach ($processors as $processor)
        {
            $html = $html . sprintf("<option value=\"%d\">%s</option>",$processor->getId(), $processor->getName());
        }
        if ($html)
            $html = sprintf("<option value=\"%d\">%s</option>","", "Escolha o Processador") . $html;

        //var_dump($html);exit;
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

            $this->get('send_mail')->sendEmail($ad, 'newmsg');

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
        
        if (isset($request->request->get('ilist_frontendbundle_ad')['price'])) {
            $price = $request->request->get('ilist_frontendbundle_ad')['price'];
            if ($price) {
                $price = str_replace('.', '', $price);
                $price = str_replace(',', '.', $price);
                $data = $request->request->get('ilist_frontendbundle_ad');
                $data['price'] = $price;
                $request->request->set('ilist_frontendbundle_ad', $data);
            }
        }
        
        $form->handleRequest($request);

        
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $user = $this->get('security.context')->getToken()->getUser();
            
            $entity->setUser($user);
            $entity->setStatus(-1); //revisao
            //$entity->setSlug($entity->getTitle());

            $entity->setPrice($entity->getPrice()/100);    
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
           
            

            $this->get('send_mail')->sendEmail($entity, 'revision');

            //$this->get('send_mail')->sendEmailToMe($entity, 'revision');
            

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


        $form = $this->createForm(new NewAdType(), $entity, array(
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
    public function newWizardAction(Request $request)
    {

        /*$em = $this->get('doctrine')->getManager();
        $category_repo = $em->getRepository('iListBackendBundle:Category');
     
        $categoryId = 1;

        $category = $category_repo->findOneById($categoryId);
        //$entity->setCategory();
        //$form = new NewAdType();*/

        $entity = new Ad();
        
        $form   = $this->createCreateForm($entity);

        //$form = $this->createForm(new NewAdType(), $entity, array(
        //    'action' => $this->generateUrl('anuncio_new_wizard'),
        //    'method' => 'POST',
        //));

        $form->handleRequest($request);
        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($form);exit;
        if ($form->isValid()) {
            die('a');
        }


        //$form   = $this->createCreateForm($entity);
        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($request);exit;

        return $this->render('iListFrontendBundle:Ad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function newWizardA2ction(Request $request) {
        $subcategories = new SubCategory();

        $form = $this->createForm(new SubCategoryType(), $subcategories);
        $form->handleRequest($request);

        return $this->render('iListFrontendBundle:Ad:wizard2.html.twig', array(
                    'form' => $form->createView(),
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

        $user = $this->get('security.context')->getToken()->getUser();

        if (!$user)
            return $this->redirect($this->generateUrl('home'));

        $entity = $em->getRepository('iListBackendBundle:Ad')->findOneBy(
            array( 'id' => $id, 'user' => $user)
        );

        if (!$entity) {
            return $this->redirect($this->generateUrl('account_home'));
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
        $form = $this->createForm(new NewAdType(), $entity, array(
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

        $user = $this->get('security.context')->getToken()->getUser();

        if (!$user)
            return $this->redirect($this->generateUrl('home'));

        if (!$entity) {
            return $this->redirect($this->generateUrl('home'));
        }

        if (isset($request->request->get('ilist_frontendbundle_ad')['price'])) {
            $price = $request->request->get('ilist_frontendbundle_ad')['price'];
            if ($price) {
                $price = str_replace('.', '', $price);
                $price = str_replace(',', '.', $price);
                $data = $request->request->get('ilist_frontendbundle_ad');
                $data['price'] = $price;
                $request->request->set('ilist_frontendbundle_ad', $data);
            }
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
            $entity->setStatus(-1); //revisao
            
            
            $i = 1;
            foreach ($entity->getAdImages() as $adImage)
            {
                
                $entity->setDefaultImg('indo');
                $adImage->setAds($entity);
                $adImage->setPosition($i++);
                $file = $adImage->getPic();
                $adImage->setPic(null);
                $adImage->setFile($file);
            }

            $em->persist($entity);
            $em->flush();

            $img = $entity->getAdImages();
            if ($img) 
            {
                $entity->setDefaultImg($img[0]->getPic());
                $em->persist($entity);
                $em->flush();
            }

            //return $this->redirect($this->generateUrl('anuncio_edit', array('id' => $id)));
            $this->get('send_mail')->sendEmail($entity, 'revision');
            

            return $this->render('iListFrontendBundle:Ad:review.html.twig');
        }

        return $this->render('iListFrontendBundle:Ad:new.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }



    public function chooseReasonAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();


        $user = $this->get('security.context')->getToken()->getUser();

        if (!$user)
            return $this->redirect($this->generateUrl('home'));

        $ad = $em->getRepository('iListBackendBundle:Ad')->findOneBy(
            array( 'id' => $id, 'user' => $user, 'status' => 1)
        );

        if (!$ad) {
            return $this->redirect($this->generateUrl('home'));
        }

        $entity = $em->getRepository('iListBackendBundle:DeletedReason')->findAll();

        $form = $this->createForm(new DeletedReasonType(), null, array(
            'action' => $this->generateUrl('anuncio_delete', array('id' => $id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'Excluir'));
        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($form->createView());exit;
        return $this->render('iListFrontendBundle:Ad:choose_reason.html.twig', array(
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }
    /**
     * Deletes a Ad entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        //$form = $this->createForm($id);
        //$form->handleRequest($request);
        //var_dump($form->isValid());exit;
        //if ($form->isValid()) {

        $em = $this->getDoctrine()->getManager();
        //$ad = $em->getRepository('iListBackendBundle:Ad')->find($id);
        $user = $this->get('security.context')->getToken()->getUser();

        if (!$user)
            return $this->redirect($this->generateUrl('home'));

        $entity = $em->getRepository('iListBackendBundle:Ad')->findOneBy(
            array( 'id' => $id, 'user' => $user)
        );

        if (!$entity) {
            return $this->redirect($this->generateUrl('home'));
        }

        //$em->remove($entity);
        $deleted_reason_id = $request->request->get('ilist_frontendbundle_deleted_reason');
        $deleted_reason = $em->getRepository('iListBackendBundle:DeletedReason')->findOneBy(
            array( 'id' => $deleted_reason_id['msg'])
        );
        //var_dump($deleted_reason);exit;
        $entity->setStatus(-1000); //deleted
        $entity->setDeletedReason($deleted_reason);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
                    'delete',
                    'Anúncio excluído com sucesso!');


        return $this->redirect($this->generateUrl('account_ads'));
        //}
        /*$entity = $em->getRepository('iListBackendBundle:DeletedReason')->findAll();

        return $this->render('iListFrontendBundle:Ad:choose_reason.html.twig', array(
            'entity'      => $entity,
            'form'   => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ));*/
        
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
