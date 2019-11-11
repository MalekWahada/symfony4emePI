<?php

namespace EchangeBundle\Form;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use EchangeBundle\Controller\EchangeController;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Choice;

class EchangeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('idprop', EntityType::class,array(
            'class' => 'EchangeBundle:Livres',

            // uses the User.username property as the visible option string
            'choice_label' => 'nom',

        ))->add('iddem',EntityType::class,array(
            'class' => 'EchangeBundle:Livres',

            // uses the User.username property as the visible option string
            'choice_label' => 'nom',
        ) )->add('stat',ChoiceType::class, array(
            'choices' =>array(
                'Bon' => 'Bon',
                'Moyen' => 'Moyen',
                'Use' => 'Use',
            )
        ))->add('descr', TextType::class)->add('numcontact',NumberType::class)->add('lieuech',EntityType::class,array(
            // looks for choices from this entity
            //
            //
            'class' => 'EchangeBundle:Locaux',

            // uses the User.username property as the visible option string
            'choice_label' => 'Adrs',
        ));
    // used to render a select box, check boxes or radios
    // 'multiple' => true,
    // 'expanded' => true,);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EchangeBundle\Entity\Echange'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'echangebundle_echange';
    }


}
