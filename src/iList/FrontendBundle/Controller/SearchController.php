<?php

namespace iList\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use iList\BackendBundle\Entity\Product;
use iList\FrontendBundle\Form\iPhoneFilterType;
use iList\FrontendBundle\Form\iPadFilterType;
use iList\FrontendBundle\Form\iPodFilterType;
use iList\FrontendBundle\Form\MacBookFilterType;
use iList\FrontendBundle\Form\iMacFilterType;
use iList\FrontendBundle\Form\AcessoriesFilterType;

use iList\BackendBundle\Classes\Tools;

class SearchController extends Controller
{
    public function indexAction($category_name, $state, $subcategory_name)
    {	
        

        $domain = $this->container->parameters['base_host'];

    	$em = $this->getDoctrine()->getManager();


        /* posso melhorar aqui dps colocando a busca pelo id ipod=1, iphone=2 ... */
        $category = $em->getRepository('iListBackendBundle:Category')
            ->findOneBy(array('name' => $category_name));

        //$subcategory = $em->getRepository('iListBackendBundle:SubCategory')
        //    ->findOneBy(array('name' => $subcategory_name));

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
        {
        	$filters['category'] = $category;
            switch ($category_name)
            {
                case 'iphone':
                    $filterForm = $this->createForm(new iPhoneFilterType());
                    break;
                case 'ipad':
                    $filterForm = $this->createForm(new iPadFilterType());
                    break;
                case 'ipod':
                    $filterForm = $this->createForm(new iPodFilterType());
                    break;

                case 'macbook':
                    $filterForm = $this->createForm(new MacBookFilterType());
                    break;
                case 'imac':
                    $filterForm = $this->createForm(new iMacFilterType());
                    break;
                case 'acessorios':
                    $filterForm = $this->createForm(new AcessoriesFilterType());
                    break;
            }
            
        }
        //if ($subcategory)
        //	$filters['subcategory'] = $subcategory;

        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($filterForm->createView());exit;

        $qb = $em->createQueryBuilder();
        $qb->select('f')
            ->from('iListBackendBundle:Ad', 'f')
            ->where('f.category = :category')
            ->orderBy('f.createdAt', 'desc');

        
        
        if ($this->getRequest()->getMethod() == 'POST') 
        {
            $filterForm->handleRequest($this->getRequest());

            $data = $filterForm->getData();

            if (!empty($data['adType'])) { 
                $qb->andWhere('f.adType in (:adType)');
                $filters['adType'] = $data['adType'];
            }

            
            if (!$data['size']->isEmpty())
            {
                foreach ($data['size'] as $size)
                    $filters['size'][] = $size;

                $qb->andWhere('f.size in (:size)');
            }

            if ($data['price_min'])
            {
                $qb->andWhere('f.price >= (:price_min)');
                $filters['price_min'] = $data['price_min'];
            }
            if ($data['price_max'])
            {   
                $qb->andWhere('f.price <= (:price_max)');
                $filters['price_max'] = $data['price_max'];
            }

            if (!$data['screen']->isEmpty())
            {
                foreach ($data['screen'] as $screen)
                    $filters['screen'][] = $screen;

                $qb->andWhere('f.screen in (:screen)');
            }

            if (!$data['processor']->isEmpty())
            {
                foreach ($data['processor'] as $processor)
                    $filters['processor'][] = $processor;

                $qb->andWhere('f.processor in (:processor)');
            }

            if (!$data['memory']->isEmpty())
            {
                foreach ($data['memory'] as $memory)
                    $filters['memory'][] = $memory;

                $qb->andWhere('f.memory in (:memory)');
            }

            //unset($filters['price_min'], $filters['price_max']);
            
            if (!$data['subcategory']->isEmpty())
            {
                foreach ($data['subcategory'] as $sub)
                    $filters['subcategory'][] = $sub;

                $qb->andWhere('f.subcategory in (:subcategory)');
            }
            

            //$filters['category'] = $filters['category'];
            
        }
        //var_dump($this->getRequest()->request);exit; 

        
        $logger = new \Doctrine\DBAL\Logging\DebugStack();
        $em->getConnection()
            ->getConfiguration()
            ->setSQLLogger($logger);
        
        $filters['status'] = 1;
        $qb->andWhere('f.status = :status');
        $qb->setParameters($filters);
        if ($state != "brasil")
            $qb->andWhere('f.state = :state');

        

        //var_dump();
        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($logger->queries);
        //\Doctrine\Common\Util\Debug::dump($filters);
        //\Doctrine\Common\Util\Debug::dump($qb->getQuery());exit;
        $ads = $qb->getQuery()->getResult();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $ads,
            $this->get('request')->query->get('page', 1)/*page number*/,
            5
        );


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        // Simple example
        //$breadcrumbs->addItem("Home", $this->get("router")->generate("i_list_backend_homepage"));



 
         //echo "<pre>";
        // var_dump($state);
        //\Doctrine\Common\Util\Debug::dump($pagination);exit;
        return $this->render('iListFrontendBundle:Search:index.html.twig', 
        	array('ads' => $ads, 
                'state' => $state, 
                'domain' => $domain, 
                'pagination' => $pagination,
                'category' => $category_name,
                'filterForm' => $filterForm->createView()
        	));
    }

    public function searchZipcodeAction($zipcode)
    {
        $html = new Tools();
        //Tools::slugify($html);
        var_dump($zipcode);exit;
    }
}
