<?php
namespace App\Form;

use App\Entity\Question;
use App\Entity\ResponseQuizz;
//use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionResponseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('textQuestion', TextType::class,  [
                'label' => 'Complétez la fiche du générique par métier si ce sont des anciens des Gobelins. Exemple : réalisateur, acteur, etc.',
            ])
            ->add('responseQuizzs', CollectionType::class, [
                'label' => ' ',
                'entry_type' => QuizzResponseFormType::class,
                'allow_add' => true,
                'by_reference' => false
            ])
            ->add('save', SubmitType::class, ['label' => 'Valider le générique'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }

}