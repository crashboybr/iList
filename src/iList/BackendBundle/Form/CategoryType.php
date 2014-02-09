<?php

namespace iList\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('sizes' , 'entity' , array(
                      'class'    => 'iListBackendBundle:Size' ,
                      'property' => 'size' ,
                      'expanded' => true ,
                      'multiple' => true , ))
            ->add('colors' , 'entity' , array(
                      'class'    => 'iListBackendBundle:Color' ,
                      'property' => 'name' ,
                      'expanded' => true ,
                      'multiple' => true , ))
            ->add('screens' , 'entity' , array(
                      'class'    => 'iListBackendBundle:ScreenSize' ,
                      'property' => 'size' ,
                      'expanded' => true ,
                      'multiple' => true , ))
            ->add('processors' , 'entity' , array(
                      'class'    => 'iListBackendBundle:Processor' ,
                      'property' => 'name' ,
                      'expanded' => true ,
                      'multiple' => true , ))
            ->add('memories' , 'entity' , array(
                      'class'    => 'iListBackendBundle:MemoryRam' ,
                      'property' => 'name' ,
                      'expanded' => true ,
                      'multiple' => true , ))
            ->add('isActive')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'iList\BackendBundle\Entity\Category'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ilist_backendbundle_category';
    }
}
