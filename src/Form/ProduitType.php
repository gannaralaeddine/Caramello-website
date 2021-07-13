<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [ 'attr'=>[ 'placeholder'=>"Saisir le titre de produit"]])
            ->add('categorie',TextType::class, [ 'attr'=>[ 'placeholder'=>"Saisir la categorie de produit"]])
            ->add('subCategorie',TextType::class, [ 'attr'=>[ 'placeholder'=>"Saisir la sous categorie de produit"]])
            ->add('description', TextareaType::class, [ 'attr'=>[ 'placeholder'=>"Saisir la description de produit", 'rows'=>10]])
            ->add('qteStock',TextType::class, [ 'attr'=>[ 'placeholder'=>"Saisir la quantité de produit"]])
            ->add('prix',TextType::class, [ 'attr'=>[ 'placeholder'=>"Saisir le prix de produit"]])
            ->add('tva',TextType::class, [ 'attr'=>[ 'placeholder'=>"Saisir le montant de TVA de produit"]])
            ->add('imageFile', FileType::class, ['required' => true]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
