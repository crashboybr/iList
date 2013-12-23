<?php

namespace iList\BackendBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('name', 'text', array('label' => 'Nome'));
        $builder->add('phone', 'text', array('label' => 'Telefone'));
    }

    public function getName()
    {
        return 'ilist_user_registration';
    }
}