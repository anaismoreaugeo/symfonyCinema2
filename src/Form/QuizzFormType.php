<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class QuizzFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,[
                'label' => 'Titre du film',
                'required' => false, // Si le champ n'est pas obligatoire
            ])

            /*->add('videoPath', UrlType::class, [
                'label' => 'Video (MP4, AVI, etc.)',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k', // Taille maximale du fichier (1 Mo ici)
                        'mimeTypes' => [
                            'video/*', // Accepte tous les types de fichiers vidéo
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier vidéo valide',
                    ]),
                ],
            ])*/
            ->add('videoPath', UrlType::class, [
                'label' => 'URL de la vidéo YouTube',
                'required' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Ajouter le film',
            ]);
        ;
    }
}