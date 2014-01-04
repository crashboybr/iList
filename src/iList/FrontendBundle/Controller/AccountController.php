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
use iList\BackendBundle\Entity\AdMsg;

use iList\BackendBundle\Classes\Tools;

class AccountController extends Controller
{
    public function indexAction(Request $request)
    {	
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $msgs = $em->getRepository('iListBackendBundle:AdMsg')->findBy(array('toUser' => $user), array('createdAt' => 'DESC'));
        /*$query = $em->createQuery(
            'SELECT p
            FROM iListBackendBundle:AdMsg p
            WHERE p.toUserId = ' . $user->getId() . '
            GROUP BY p.fromUserId, p.adId'
        );

        $msgs = $query->getResult();*/
        //echo "<pre>";
        $all_msgs = array();
        foreach ($msgs as $msg)
        {
            $all_msgs[$msg->getAdId()][$msg->getFromUserId()]['msg_title'] = $msg->getTitle();
            $all_msgs[$msg->getAdId()][$msg->getFromUserId()]['msg'][] = $msg;
            
        }
        foreach ($all_msgs as $msgs)
            foreach ($msgs as $msg)
        {
            //\Doctrine\Common\Util\Debug::dump($msg);exit;
        }
        //\Doctrine\Common\Util\Debug::dump($all_msgs);exit;
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
            'ads' => $ads,
            'all_msgs' => $all_msgs

            ));
    }

    public function replyMsgAction(Request $request)
    {

        $entity = new AdMsg();
        
        $ad_id = $request->get('ad_id');
        $user_id = $request->get('user_id');
        $msg = $request->get('msg');

        $em = $this->getDoctrine()->getManager();
        $ad = $em->getRepository('iListBackendBundle:Ad')->find($ad_id);
        $user = $em->getRepository('iListBackendBundle:User')->find($user_id);
        
        $me = $this->getUser();
        
        $entity->setFromUser($me);

        $entity->setName($me->getName());
        $entity->setEmail($me->getEmail());
        $entity->setAd($ad);
        $entity->setToUser($user);
        $entity->setContent($msg);
        $entity->setTitle("RE: " . $ad->getTitle());
        $entity->setStatus(-1); //nao lido
            
        $em->persist($entity);
        $em->flush($entity);

        $this->get('session')->getFlashBag()->add(
        'notice',
        'Resposta enviada com sucesso!');

        return $this->redirect($this->generateUrl('account_home'));
 
    }

}
