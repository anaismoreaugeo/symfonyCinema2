<?php
namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class QuestionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('textQuestion', TextType::class, [
                'label' => 'Complétez la fiche du générique par métier si ce sont des anciens des Gobelins. Exemple : réalisateur, acteur, etc.',
            ]);
        ;
    }
}