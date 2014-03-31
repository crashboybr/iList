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
use iList\BackendBundle\Entity\User;
use iList\BackendBundle\Form\UserType;

use iList\BackendBundle\Classes\Tools;

use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\DependencyInjection\ContainerAware;


use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
        
        

        
        return $this->render('iListFrontendBundle:Account:index.html.twig',array(
            'all_msgs' => $all_msgs

            ));
    }
    /*public function profileAction(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(new UserType(), $user, array(
            'action' => $this->generateUrl('account_profile'),
            'method' => 'POST',
        ));

        return $this->render('iListFrontendBundle:Account:profile.html.twig',array(
            'form' => $form->createView()

            ));
    }*/

    public function adsAction(Request $request)
    {
        $user = $this->getUser();

        $ads = $user->getAds();

        return $this->render('iListFrontendBundle:Account:ads.html.twig',array(
            'ads' => $ads

            ));
    }

    public function profileAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form = $this->createForm(new UserType(), $user, array(
            'action' => $this->generateUrl('account_home'),
            'method' => 'POST',
        ));

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
                $userManager = $this->container->get('fos_user.user_manager');

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('fos_user_profile_show');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Dados alterados com sucesso!');

                //return $response;
                return $this->container->get('templating')->renderResponse(
                    'iListFrontendBundle:Account:profile.html.twig', array('form' => $form->createView())
                );
            }
        }

        return $this->container->get('templating')->renderResponse(
            'iListFrontendBundle:Account:profile.html.twig', array('form' => $form->createView())
        );
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

        //$this->get('send_mail')->sendEmail($user->getEmail(), 'Vc teve uma resposta na sua caixa de entrada', 'Nova Msg');
        $this->get('send_mail')->sendEmail($ad, 'newmsg');

        return $this->redirect($this->generateUrl('account_home'));
 
    }

}
