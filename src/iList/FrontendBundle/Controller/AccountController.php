<?php

namespace iList\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use iList\BackendBundle\Entity\Product;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\HttpFoundation\Session\Session;

use iList\BackendBundle\Classes\Tools;

class AccountController extends Controller
{
    public function indexAction(Request $request)
    {	
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $msgs = $em->getRepository('iListBackendBundle:AdMsg')->findBy(array('toUser' => $user));
        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($msgs);exit;

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');
        
        //$user = $this->get('security.context')->getToken()->getUser();
        
        $ads = $user->getAds();
    
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, new UserEvent($user, $request));
    
        $form = $formFactory->createForm();
        $form->setData($user);

    	
        return $this->render('iListFrontendBundle:Account:index.html.twig',array(
            'form' => $form->createView(),
            'ads' => $ads

            ));
    }


}
