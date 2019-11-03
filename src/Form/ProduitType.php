<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 03/11/2019
 * Time: 11:22
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('numeroSerie',TextType::class)
           ->add('nom',TextType::class)
           ->add('matiere',TextType::class)
           ->add('couleur',TextType::class)
           ->add('taille',TextType::class)
           ->add('marque',TextType::class)
           ->add('prix',NumberType::class,[
               'label' => "Prix",
               'scale' => 2
           ]);
    }

}