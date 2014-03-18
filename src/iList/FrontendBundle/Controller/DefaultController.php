<?php

namespace iList\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\HttpFoundation\Session\Session;


class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {	

        //var_dump($this->get('mailer_helper')->sendEmail('a','b','c'));exit;
    	/** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');
    	
    	$user = $this->get('security.context')->getToken()->getUser();


        //var_dump($user);exit;
        if ($user == "anon.")
			$user = $userManager->createUser();
        //$user->setEnabled(true);

    
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, new UserEvent($user, $request));
    
        $form = $formFactory->createForm();
        $form->setData($user);

        return $this->render('iListFrontendBundle:Default:index.html.twig',array('form' => $form->createView()));
    }


    public function bomAction(Request $request)
    {   

        $html = file_get_contents('http://rj.bomnegocio.com/rio-de-janeiro-e-regiao/computadores-e-acessorios/macbook-air-a1369-i5-29888575');
        
        $html = preg_replace( "/\r|\n/", "", $html );
        //var_dump($html);exit;
        

        preg_match('#<h1 id="ad_title" class="title">(.+)- <span class#s',$html,$match_title);

        preg_match('#<p class="description">(.+)<div class="ad_details_section">#s',$html,$match_desc);

        preg_match('#<span class="price highlight"> (.+)<span class="type">#s',$html,$match_price);

        preg_match('#<li id="thumb1" class="item ">(.+)<a class="link" href="(.+)</li>#s',$html,$match_pic1);

        
        
        var_dump($match_pic1);exit;
        
        $title = trim($match_title[1]);

        $desc = trim(preg_replace( "#<\/p>|<\/div>#", "", trim($match_desc[1])));

        $price = trim(preg_replace( "#<\/span>|<\/h1>#", "", trim($match_price[1])));
        
        //var_dump($price);exit;

        echo ($html);exit;
        exit;
            
    }


}
