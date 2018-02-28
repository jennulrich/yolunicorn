<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 28/02/2018
 * Time: 15:03
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('prenom', TextType::class)
            ->add('age', NumberType::class)
            ->add('email',TextType::class)
            ->add('pseudo', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Modifier les informations']);
    }
}