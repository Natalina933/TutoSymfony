<?php

namespace App\Form;

use App\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Validator\Constraints\Regex;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => false,
                'constraints' => new Length(min: 10, max: 255),
                'label' => 'Titre de la recette'
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug de la recette',
                'required' => false,
                'constraints' => [
                    new Length(min: 5, max: 255),
                    new Regex([
                        'pattern' => '/^[a-z0-9-]+$/',
                        'message' => 'Le slug doit contenir uniquement des lettres minuscules, des chiffres et des tirets.'
                    ])
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu de la recette'
            ])
            ->add('duration', IntegerType::class, [
                'label' => 'Durée (minutes)'
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'autoSlug'])
            ->addEventListener(FormEvents::POST_SUBMIT, [$this, 'attachTimestamps']);
    }

    public function autoSlug(PreSubmitEvent $event): void
    {
        $data = $event->getData();
        if (empty($data['slug']) && !empty($data['title'])) {
            $slugger = new AsciiSlugger();
            $data['slug'] = $slugger->slug($data['title'])->lower();
            $event->setData($data);
        }
    }

    public function attachTimestamps(PostSubmitEvent $event): void
    {
        $data = $event->getData();
        if (!$data instanceof Recipe) {
            return;
        }

        $data->setUpdatedAt(new \DateTimeImmutable());
        if (!($data->getId())) {
            $data->setCreatedAt(new \DateTimeImmutable());
            if ($data->getUpdatedAt() === null) {
                $data->setUpdatedAt(new \DateTimeImmutable());
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
