<?php

namespace AppBundle\Form;

use AppBundle\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class)
            ->add('annee', DateTimeType::class)
            ->add('acteur', TextType::class)
            ->add('description',TextareaType::class)
            ->add('genres', EntityType::class,  [
                    'class' => Genre::class,
                    'choice_label' => 'genreCat',
                    'expanded' => true,
                    'multiple' => true
                ])
            ->add('image', FileType::class, array('label' => 'Image(JPG)'))
            ->add('save', SubmitType::class, ['label' => 'Ajouter un Film']);
    }
}