<?php

namespace iList\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use iList\BackendBundle\Entity\Product;

class SearchController extends Controller
{
    public function indexAction($category_name, $state, $subcategory_name)
    {	

    	
    	$domain = $this->container->parameters['domain'];

    	$em = $this->getDoctrine()->getManager();
        

        /* posso melhorar aqui dps colocando a busca pelo id ipod=1, iphone=2 ... */
        $category = $em->getRepository('iListBackendBundle:Category')
            ->findOneBy(array('name' => $category_name));

        $subcategory = $em->getRepository('iListBackendBundle:SubCategory')
            ->findOneBy(array('name' => $subcategory_name));

        if (!$category)
        {
        	//return $this->redirect($this->generateUrl('i_list_frontend_homepage'));
        } 

       
        if ($state == "brasil")
        {
        
        	$filters = array();
        }
        else
        {
        	 $filters = array('state' => $state);
        }

        if ($category)
        	$filters['category'] = $category;

        if ($subcategory)
        	$filters['subcategory'] = $subcategory; 


        $ads = $em->getRepository('iListBackendBundle:Ad')
        	->findBy($filters, array('createdAt' => 'DESC'));
 
         //echo "<pre>";
        // var_dump($state);
        //\Doctrine\Common\Util\Debug::dump($category);exit;
        return $this->render('iListFrontendBundle:Search:index.html.twig', 
        	array('ads' => $ads, 'state' => $state, 'domain' => $domain)
        	);
    }
}
