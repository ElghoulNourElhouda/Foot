<?php

namespace App\Form;

use App\Entity\Statistique;
use App\Entity\Joueur;
use App\Entity\Equipe;
use App\Entity\Saison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbrematchs')
            ->add('nbrebuts')
            ->add('nbreminutes')
            ->add('nbrepasses')
            ->add('equipe', EntityType::class, [
                // looks for choices from this entity
                'class' => Equipe::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'nom',
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('saison', EntityType::class, [
                // looks for choices from this entity
                'class' => Saison::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'date',
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Statistique::class,
        ]);
    }
}
