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
            ->setFrom("contato@ilists.com.br")
            ->setTo($user->getEmail())
            ->setBody($body, 'text/html');


        $this->mailer->send($message);
    }
}