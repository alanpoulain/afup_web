<?php


namespace AppBundle\Form;


use AppBundle\Model\Talk;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TalkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre'])
            ->add('abstract', TextareaType::class, ['label' => 'Résumé'])
            ->add(
                'type',
                ChoiceType::class,
                ['label' => 'Type', 'choices' =>
                    [
                        'Conférence plénière (40 mn)' =>  Talk::TYPE_FULL_LONG,
                        'Conférence plénière (20 mn)' => Talk::TYPE_FULL_SHORT,
                        'Atelier' => Talk::TYPE_WORKSHOP,
                    ]
                ]
            )
            ->add(
                'skill',
                ChoiceType::class,
                ['label' => 'Niveau requis', 'choices' =>
                    [
                        'Débutant' =>  Talk::SKILL_JUNIOR,
                        'Intermédiaire' => Talk::SKILL_MEDIOR,
                        'Avancé' => Talk::SKILL_SENIOR,
                        'N/A' => Talk::SKILL_NA
                    ]
                ]
            )
            ->add('save', SubmitType::class, ['label' => 'Sauvegarder'])
        ;
    }
}
