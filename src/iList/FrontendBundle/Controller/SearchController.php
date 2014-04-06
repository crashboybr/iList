<?php

namespace iList\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use iList\BackendBundle\Entity\Product;
use iList\BackendBundle\Entity\Search;
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
        
        
        $q = $this->get('request')->query->get('q');
        
        $domain = $this->container->parameters['base_host'];

    	$em = $this->getDoctrine()->getManager();


        /* posso melhorar aqui dps colocando a busca pelo id ipod=1, iphone=2 ... */
        $category = $em->getRepository('iListBackendBundle:Category')
            ->findOneBy(array('name' => $category_name));

        

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        // Simple example
        $breadcrumbs->addItem("Home", $this->get("router")->generate("home"));
        if ($state == "brasil")
            $breadcrumbs->addItem("Brasil", $this->get("router")->generate("brasil_search"));
        else
            $breadcrumbs->addItem(strtoupper($state), $this->get("router")->generate("subdomain_search", array('state' => $state)));

        $filterForm = null;
        
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
            if ($state == "brasil")
                $breadcrumbs->addItem($category->getName(), $this->get("router")->generate("brasil_search", array('category_name' => $category_name)));
            else
                $breadcrumbs->addItem($category->getName(), $this->get("router")->generate("subdomain_search", array('state' => $state, 'category_name' => $category_name))); 
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
        else
        {
            //$filters['category'] = null;
        }
        //if ($subcategory)
        //	$filters['subcategory'] = $subcategory;

        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($filterForm->createView());exit;
        

        $qb = $em->createQueryBuilder();
        $qb->select('f')
            ->from('iListBackendBundle:Ad', 'f')
            //->where('f.category = :category')
            ->orderBy('f.createdAt', 'desc');
        if ($category)
            $qb->andWhere('f.category = :category');
        if ($q)
        {
            $search = new Search();
            $search->setQuery($q);
            $search->setIp($_SERVER['REMOTE_ADDR']);

            $em->persist($search);
            $em->flush($search);

            $q = "%" . $q . "%";
            $filters['q'] = $q;
            $qb->andWhere('f.title like :q');
        }
        
        
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

            if (isset($data['screen']))
                if (!$data['screen']->isEmpty())
                {
                    foreach ($data['screen'] as $screen)
                        $filters['screen'][] = $screen;

                    $qb->andWhere('f.screen in (:screen)');
                }
            if (isset($data['processor']))
                if (!$data['processor']->isEmpty())
                {
                    foreach ($data['processor'] as $processor)
                        $filters['processor'][] = $processor;

                    $qb->andWhere('f.processor in (:processor)');
                }
            
            if (isset($data['memory']))
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
        
        if ($state != "brasil")
            $qb->andWhere('f.state in (:state)');

        $qb->setParameters($filters);
        
    
        
        $ads = $qb->getQuery()->getResult();

        if (count($ads) == 0)
        {
            $filters['state'] = array(
                "ac","al","am","ap","ba","ce","df","es","go","ma","mg","ms","mt","pa","pb","pe","pi","pr","rj","rn","ro","rr","rs","sc","se","sp","to"
            );
            //var_dump($filters);exit;
            $qb->setParameters($filters);
            //$qb->andWhere('f.state != :state');
            $ads = $qb->getQuery()->getResult();
            $this->get('session')->getFlashBag()->add(
                    'failover',
                    'Busca não foi encontrada. Expandindo para todo Brasil.');


        }
        //var_dump();
        
        //\Doctrine\Common\Util\Debug::dump($logger->queries);
        //\Doctrine\Common\Util\Debug::dump($filters);
        
        //exit;

        $page_number = $this->get('request')->get('pagina') ? $this->get('request')->get('pagina') : 1; 
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $ads,
            $this->get('request')->query->get('page', $page_number)/*page number*/,
            10
        );


         //echo "<pre>";
        // var_dump($state);
        //\Doctrine\Common\Util\Debug::dump($pagination);exit;
        
        if ($filterForm)
            $filterForm = $filterForm->createView();



        return $this->render('iListFrontendBundle:Search:index.html.twig', 
        	array('ads' => $ads, 
                'state' => $state, 
                'domain' => $domain, 
                'pagination' => $pagination,
                'category' => $category_name,
                'filterForm' => $filterForm
        	));
    }

    public function searchZipcodeAction($zipcode)
    {
        $html = new Tools();
        //Tools::slugify($html);
        var_dump($zipcode);exit;
    }
}
