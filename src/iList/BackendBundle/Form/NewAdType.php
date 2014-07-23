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

class NewAdType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
      

        $states[''] = 'Escolha o Estado';
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
            ->add('category', 'entity', array(
                'class'       => 'iListBackendBundle:Category',
                'empty_value' => 'Escolha o Produto',
                'expanded'    => false,
                'multiple'    => false

                ))
            ->add('adType', 'choice', array(
                'choices' => array('1' => 'Venda', '2' => 'Compra'),
                'expanded' => true,
                'data' => '1',
            ))
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
                'attr' => array('onchange' => 'changeZipcode("ad")', 'maxlength' => 9),
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
            ->add('ad_images', 'collection', array('type' => new AdImageType(), 'required' => false))

            ;

            

        $formModifier = function(FormInterface $form, Category $category = null) {
            $subcategories = null === $category ? array() : $category->getSubCategories();

            $colors = null === $category ? array() : $category->getColors();
            $sizes = null === $category ? array() : $category->getSizes();
            $memories = null === $category ? array() : $category->getMemories();
            $screens = null === $category ? array() : $category->getScreens();
            $processors = null === $category ? array() : $category->getProcessors();
            //$form->remove('subcategory');
            $form->add('subcategory', 'entity', array(
                'class'       => 'iListBackendBundle:SubCategory',
                'empty_value' => 'Escolha um Modelo',
                'choices'     => $subcategories,
            ));

            $form->add('color', 'entity', array(
                'class'       => 'iListBackendBundle:Color',
                'empty_value' => 'Escolha a Cor',
                'choices'     => $colors,
                'property'    => 'name', 'required' => false
            ));

            $form->add('size' , 'entity' , array(
                      'class'    => 'iListBackendBundle:Size' ,
                      'property' => 'size' ,
                      'choices'     => $sizes,
                      'empty_value' => 'Escolha a Capacidade',
                      'required' => false ));
            $form->add('memory' , 'entity' , array(
                      'class'    => 'iListBackendBundle:MemoryRam' ,
                      'property' => 'name' ,
                      'choices'     => $memories,
                      'empty_value' => 'Escolha a Memória', 'required' => false ));
            $form->add('screen' , 'entity' , array(
                      'class'    => 'iListBackendBundle:ScreenSize' ,
                      'property' => 'size' ,
                      'choices'     => $screens,
                      'empty_value' => 'Escolha o tamanho da tela', 'required' => false ));
            $form->add('processor' , 'entity' , array(
                      'class'    => 'iListBackendBundle:Processor' ,
                      'property' => 'name' ,
                      'choices'     => $processors,
                      'empty_value' => 'Escolha o Processador', 'required' => false ));

        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                //var_dump($data->getColor());exit;

                $formModifier($event->getForm(), $data->getCategory());
            }
        );

        $builder->get('category')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $category = $event->getForm()->getData();


                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $category);
            }
        );

/*
        $formModifierColor = function(FormInterface $form, SubCategory $subcategory = null) {
            
            //var_dump($subcategory);exit;
            $colors = null === $subcategory ? array() : $subcategory;

            $form->add('color', 'entity', array(
                'class'       => 'iListBackendBundle:Color',
                'empty_value' => 'Escolha uma Cor',
                'property'    => 'name',
                'choices'     => $colors,
            ));
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function(FormEvent $event) use ($formModifierColor) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                //var_dump($data->getColor());exit;

                $formModifierColor($event->getForm(), $data->getColor());
            }
        );

        $builder->get('subcategory')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) use ($formModifierColor) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $subcategory = $event->getForm()->getData();
                //var_dump($subcategory);exit;
                
                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifierColor($event->getForm()->getParent(), $subcategory);
            }
        );*/
        



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
