<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('streetName',TextType::class,[
                'label' => 'Nom de rue',
            ])
            ->add('companyName',TextType::class,[
                'label' => 'Nom de société',
            ])
            ->add('postalCode',TextType::class,[
                'label' => 'Code postale',
            ])
            ->add('city',TextType::class,[
                'label' => 'Ville',
            ])
            ->add('country',TextType::class,[
                'label' => 'Pays',
            ])
            ->add('siret',TextType::class,[
                'label' => 'SIRET',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
