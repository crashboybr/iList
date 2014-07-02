<?php

namespace iList\FrontendBundle\Util;


class Mailer 
{
    protected $mailer;
    protected $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendEmail($ad, $type)
    {
        //die('a');

        // Load the template in
        $user = $ad->getUser();

        $templateFile = "iListFrontendBundle:Email:email-" . $type . ".html.twig";
        //$templateFile = "iListFrontendBundle:Email:email-published.html.twig";
        $templateContent = $this->twig->loadTemplate($templateFile);

        // Render the whole template including any layouts etc

        $body = $templateContent->renderBlock("body", array("user" => $user, "ad" => $ad));

        $subject = ($templateContent->hasBlock("subject")
            ? $templateContent->renderBlock("subject", array())
            : "Compra e venda de Apple");


        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom("contato@ilist.com.br")
            ->setTo($user->getEmail())
            //->setCco('bernardoniteroi@gmail.com')
            ->setBcc('bernardoniteroi@gmail.com')
            ->setBody($body, 'text/html');


        $this->mailer->send($message);
    }

    public function sendAdReply($conf, $type)
    {

        $me     = $conf['from'];
        $toUser = $conf['to'];
        $ad     = $conf['ad'];

        // Load the template in
        $templateFile = "iListFrontendBundle:Email:email-" . $type . ".html.twig";
        $templateContent = $this->twig->loadTemplate($templateFile);

        // Render the whole template including any layouts etc
        $body = $templateContent->renderBlock("body", array("me" => $me, "toUser" => $toUser, "ad" => $ad));

        $subject = ($templateContent->hasBlock("subject")
            ? $templateContent->renderBlock("subject", array())
            : "Compra e venda de Apple");


        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom("contato@ilist.com.br")
            ->setTo($toUser->getEmail())
            ->setBcc('bernardoniteroi@gmail.com')
            ->setBody($body, 'text/html');


        $this->mailer->send($message);
    }

    public function sendContactEmail($data)
    {
        $subject = "Contato iList";

        $templateFile = "iListFrontendBundle:Email:email-contact.html.twig";
        //$templateFile = "iListFrontendBundle:Email:email-published.html.twig";
        $templateContent = $this->twig->loadTemplate($templateFile);

        // Render the whole template including any layouts etc

        $body = $templateContent->renderBlock("body", array("data" => $data));

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom("contato@ilist.com.br")
            ->setTo('bernardoniteroi@gmail.com')
            ->setBody($body, 'text/html');


        $this->mailer->send($message);



    }
}
