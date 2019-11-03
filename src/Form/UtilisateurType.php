<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 02/11/2019
 * Time: 10:41
 */

namespace App\Form;

use App\Document\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class)
            ->add('lastname',TextType::class)
            ->add('email',TextType::class)
            ->add('password',TextType::class)
            ->add('creation_date',DateType::class);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
