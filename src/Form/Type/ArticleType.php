<?php


namespace App\Form\Type;

use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title', TextType::class, ['required'=> true])
            ->add('Content', TextareaType::class, ['required'=> true])
            ->add('Submit', SubmitType::class);

        $builder->add('Tags', EntityType::class, [
            'class' => Tag::class,
            'choice_value' => 'Tagname',
            'choice_label' => function(?Tag $tag) {
                return $tag ? strtolower($tag->getTagname()) : '';
            },
            'choice_attr' => function(?Tag $tag) {
                return $tag ? ['class' => 'tag_'.strtolower($tag->getTagname())] : [];
            },
            'expanded' => true,
            'multiple' => true,
        ]);
    }
}