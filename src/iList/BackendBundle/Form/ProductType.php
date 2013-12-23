<?php

namespace iList\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('generations' , 'entity' , array(
                      'class'    => 'iListBackendBundle:Generation' ,
                      'property' => 'name' ,
                      'expanded' => true ,
                      'multiple' => true , ))
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
            ->add('isActive')
            ->add('category')
            ->add('subcategory')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'iList\BackendBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ilist_backendbundle_product';
    }
}
