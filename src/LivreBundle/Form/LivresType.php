<?php

namespace LivreBundle\Form;

use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\IntegerTyfpe;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivresType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('auteur',TextType::class)
            ->add('categorie',ChoiceType::class,array(
                'choices'=>array(
                    'Action'=>'Action',
                    "Romance"=>"Romance",
                    "Science Fiction"=> "Science Fiction",
                    "Comedie"=>"Comedie",
                    "Histoire"=> "Histoire",
                    "Autobiographie"=>"Autobiographie",
                    "Enfants"=>"Enfants",
                    "Fantastique"=>"Fantastique",
                    "Bande dessinée"=>"Bande dessinée",
                    "Nouvelle"=>"Nouvelle",
                    "Educatif"=>"Educatif"
                )
            ))
            ->add('mPub',TextType::class)
            ->add('img',FileType::class, array('data_class' => null)
            )
            ->add('description',TextareaType::class)
            ->add('prix',MoneyType::class,array(
                'scale'=>2,
                'currency'=> false,
            ))
            ->add('stock',IntegerType::class)
            ->add('rate',MoneyType::class,array(
                'scale'=>2,
                'currency'=> false,
            ))
            ->add('promo',promoType::class)
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LivreBundle\Entity\Livres'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'livrebundle_livres';
    }


}
