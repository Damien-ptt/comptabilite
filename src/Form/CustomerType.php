<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customerCode',TextType::class,[
                'label' => 'N° client',
            ])
            ->add('companyName',TextType::class,[
                'label' => 'Nom d\'entreprise',
            ])
            ->add('siret',TextType::class,[
                'label' => 'N°SIRET',
            ])
            ->add('streetName',TextType::class,[
                'label' => 'Nom de rue',
            ])
            ->add('city',TextType::class,[
                'label' => 'Ville',
            ])
            ->add('postalCode',TextType::class,[
                'label' => 'Code postale',
            ])
            ->add('country',TextType::class,[
                'label' => 'Pays',
            ])
            ->add('contactFirstName',TextType::class,[
                'label' => 'Prénom contact',
            ])
            ->add('contactLastName',TextType::class,[
                'label' => 'Nom contact',
            ])
            ->add('tvaNumber',TextType::class,[
                'label' => 'N° de TVA',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
