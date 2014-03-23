<?php

namespace iList\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AdType extends AbstractType
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
        
        $factory = $builder->getFormFactory();

        $builder
            ->add('adType', 'choice', array(
                'choices' => array('1' => 'Venda', '2' => 'Compra'),
                'expanded' => true,
                'data' => '1',
            ))
            ->add('category', 'entity', array(
                'class'    => 'iListBackendBundle:Category',
                'empty_value' => 'Escolha o Produto'
                ))
            ->add('subcategory', 'entity', array(
                      'class'    => 'iListBackendBundle:SubCategory' ,
                      'property' => 'name' ,
                      'expanded' => false ,
                      'multiple' => false ,
                      'empty_value' => 'Escolha o Modelo'
              )
              )
            ->add('product')
            ->add('size' , 'entity' , array(
                      'class'    => 'iListBackendBundle:Size' ,
                      'property' => 'size' ,
                      'expanded' => false ,
                      'multiple' => false ,
                      'empty_value' => 'Escolha a capacidade' ))
            ->add('color' , 'entity' , array(
                      'class'    => 'iListBackendBundle:Color' ,
                      'property' => 'name' ,
                      'expanded' => false ,
                      'multiple' => false ,
                      'empty_value' => 'Escolha a cor' ))
            ->add('memory' , 'entity' , array(
                      'class'    => 'iListBackendBundle:MemoryRam' ,
                      'property' => 'name' ,
                      'expanded' => false ,
                      'multiple' => false ,
                      'empty_value' => 'Escolha a memória' ))
            ->add('screen' , 'entity' , array(
                      'class'    => 'iListBackendBundle:ScreenSize' ,
                      'property' => 'size' ,
                      'expanded' => false ,
                      'multiple' => false ,
                      'empty_value' => 'Escolha o tamanho da tela' ))
            ->add('processor' , 'entity' , array(
                      'class'    => 'iListBackendBundle:Processor' ,
                      'property' => 'name' ,
                      'expanded' => false ,
                      'multiple' => false ,
                      'empty_value' => 'Escolha o Processador' ))
            ->add('title')
            ->add('content')
            ->add('price')
            ->add('state', 'choice', array(
                'choices' => $states,
                'attr' => array('readonly' => 'readonly')
            ))
            ->add('city','text', array(
                'attr' => array('readonly' => 'readonly')
                ))
            ->add('zipcode','text', array(
                'attr' => array('onchange' => 'changeZipcode()'),
                ))
            ->add('neighbourhood','text', array(
                'attr' => array('readonly' => 'readonly')
                ))
            ->add('street','text', array(
                'attr' => array('readonly' => 'readonly')
                ))
            ->add('complement')
            ->add('productType', 'choice', array(
                'choices' => array('1' => 'Novo', '2' => 'Usado'),
                'expanded' => true,
                'data' => '1',
            ))
            //->add('ad_images', 'file')
            //->add('ad_images', 'file', array(
            //    'data_class' => null,
            //))
            ->add('ad_images', 'collection', array('type' => new AdImageType()))
        ;




        



    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'iList\BackendBundle\Entity\Ad'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ilist_frontendbundle_ad';
    }
}
