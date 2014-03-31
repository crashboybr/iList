<?php

namespace iList\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use iList\BackendBundle\Entity\Category;
use iList\BackendBundle\Entity\SubCategory;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\CallbackValidator;
use Symfony\Component\Form\FormValidatorInterface;
use Symfony\Component\Form\FormError;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
      

        $states[''] = 'Digite seu CEP';
        $states['AC'] = 'AC - Acre';
        $states['AL'] = 'AL - Alagoas';
        $states['AM'] = 'AM - Amazonas';
        $states['AP'] = 'AP - Amapá';
        $states['BA'] = 'BA - Bahia';
        $states['CE'] = 'CE - Ceará';
        $states['DF'] = 'DF - Distrito Federal';
        $states['ES'] = 'ES - Espírito Santo';
        $states['GO'] = 'GO - Goiás';
        $states['MA'] = 'MA - Maranhão';
        $states['MG'] = 'MG - Minas Gerais';
        $states['MS'] = 'MS - Mato Grosso do Sul';
        $states['MT'] = 'MT - Mato Grosso';
        $states['PA'] = 'PA - Pará';
        $states['PB'] = 'PB - Paraíba';
        $states['PE'] = 'PE - Pernambuco';
        $states['PI'] = 'PI - Piauí';
        $states['PR'] = 'PR - Paraná';
        $states['RJ'] = 'RJ - Rio de Janeiro';
        $states['RN'] = 'RN - Rio Grande do Norte';
        $states['RO'] = 'RO - Rondônia';
        $states['RR'] = 'RR - Roraima';
        $states['RS'] = 'RS - Rio Grande do Sul';
        $states['SC'] = 'SC - Santa Catarina';
        $states['SE'] = 'SE - Sergipe';
        $states['SP'] = 'SP - São Paulo';
        $states['TO'] = 'TO - Tocantins';

        $builder
            ->add('name')
            ->add('email')
            ->add('username')
            ->add('username')
            ->add('phone')
            ->add('city','text', array(
                'attr' => array('readonly' => 'readonly')
                ))
            ->add('zipcode','text', array(
                'attr' => array('onchange' => 'changeZipcode("user")', 'maxlength' => 8),
                ))
            ->add('neighbourhood','text', array(
                'attr' => array('readonly' => 'readonly')
                ))
            ->add('street','text', array(
                'attr' => array('readonly' => 'readonly')
                ))
            ->add('complement')
            ->add('state', 'choice', array('choices' => $states))
            ->add('cpf');

            

            
        



    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'iList\BackendBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ilist_frontendbundle_user';
    }
}
