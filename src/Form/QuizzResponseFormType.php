<?php

namespace App\Form;

use App\Entity\ResponseQuizz;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizzResponseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('textResponseQuizz', TextType::class, [
                'label' => 'Nom/Prénom',
                'required' => false
            ])
            ->add('isTrue', CheckboxType::class, [
                'label' => 'Chef/Directeur',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ResponseQuizz::class,
        ]);
    }
}