<?php

namespace iList\FrontendBundle\Util;

class Mailer
{
    protected $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail($to, $body, $subject = '')
    {
        //die('a');
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('bernardoniteroi@gmail.com')
            ->setTo('bernardoniteroi@gmail.com')
            //->setTo($to)
            ->setBody($body);


        $this->mailer->send($message);
    }
}