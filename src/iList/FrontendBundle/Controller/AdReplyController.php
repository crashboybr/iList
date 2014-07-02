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
class AdReplyController extends Controller
{

    
    public function replyAdReplyAction(Request $request)
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

        $conf['from'] = $me;
        $conf['to']   = $user;
        $conf['ad']   = $ad;
 
        $this->get('send_mail')->sendAdReply($conf, 'replymsg');

        $this->get('session')->getFlashBag()->add(
        'notice',
        'Resposta enviada com sucesso!');

        return $this->redirect($this->generateUrl('account_home'));
 
    }

    public function sendAdReplyAction(Request $request)
    {

        $entity = new AdMsg();
        
        $form = $this->createAdMsgForm($entity);
        
        $form->handleRequest($request);

        $ad = $form->getData()->getAd();
        //echo "<pre>";
        //\Doctrine\Common\Util\Debug::dump($form->getData()->getAd());exit;
        $me = $this->getUser();
        if (!$me) {
            $this->get('session')->getFlashBag()->add(
                'error',
                'Você precisa estar logado para enviar uma mensagem!');
        } else {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                
                $entity->setFromUser($me);

                //echo "<pre>";
                //\Doctrine\Common\Util\Debug::dump($entity);exit;
                
                $entity->setTitle("Nova Mensagem - Anúncio: " . $ad->getTitle());
                $entity->setStatus(-1); //nao lido

                $toUser = $ad->getUser();
                $entity->setToUser($toUser);

                $em->persist($entity);
                $em->flush($entity);

                $conf['from'] = $me;
                $conf['to']   = $toUser;
                $conf['ad']   = $ad;
     

                $this->get('send_mail')->sendAdReply($conf, 'newmsg');

                $this->get('session')->getFlashBag()->add(
                'notice',
                'Mensagem enviada com sucesso!');



                return $this->redirect($this->generateUrl('subdomain_vi', 
                    array(
                        'city' => $ad->getCitySlug(),
                        'category_name' => strtolower($ad->getCategory()),
                        'slug' => $ad->getSlug(),
                        'state' => $ad->getState()
                        
                        )
                    ));
                



            }
        }
 
        return $this->render('iListFrontendBundle:Ad:viewAd.html.twig', array(
            'ad' => $ad, 
            'form' => $form->createView()
            ));
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
 
}
