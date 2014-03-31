<?php

namespace iList\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdImageType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('pic', 'file', array(
                'attr' => array('class' => 'img-pics'),
                'label' => false,
                'data_class' => null
                ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'iList\BackendBundle\Entity\AdImage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ilist_frontendbundle_ad_image';
    }
}
