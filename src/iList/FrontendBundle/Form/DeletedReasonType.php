<?php

namespace iList\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class DeletedReasonType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
   

        $builder
            ->add('msg', 'entity' , array(
                      'class'    => 'iListBackendBundle:DeletedReason' ,
                      'property' => 'msg' ,
                      'expanded' => true ,
                      'multiple' => false ,
                      ));

    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'ilist_frontendbundle_deleted_reason';
    }

    
}
