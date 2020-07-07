<?php


namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, ['attr' => ['pattern' => '[a-zA-Z]*']])
            ->add('Surname', TextType::class, ['attr' => ['pattern' => '[a-zA-Z]*']])
            ->add('Nickname', TextType::class, ['attr' => ['pattern' => '[a-zA-Z]*']])
            ->add('Email', EmailType::class, ['data' => 'name@example.com'])
            ->add('Next', SubmitType::class);
    }
}