<?php
/**
 * Created by PhpStorm.
 * User: amandine
 * Date: 28/02/2018
 * Time: 16:16
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class GenreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('genre_cat', TextType::class)
            ->add('save', SubmitType::class);
    }
}