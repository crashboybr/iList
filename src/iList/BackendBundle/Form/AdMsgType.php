<?php

namespace iList\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AdMsgType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
   
        
        
        $builder
            ->add('name', 'text', array('label' => 'Nome'))
            ->add('email', 'text', array('label' => 'Email'))
            ->add('phone', 'text', array('label' => 'Telefone (opcional)'))
            ->add('content','textarea', array('label' => 'Mensagem'))
            ->add('ad', 'hidden_entity', array(
                "class" => "iList\\BackendBundle\\Entity\\Ad"
            ));
        ;




    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'iList\BackendBundle\Entity\AdMsg'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ilist_frontendbundle_ad_msg';
    }
}
