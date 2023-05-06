<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\Invoice;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdDate',DateType::class,[
                'label' => 'Date',
                'html5' => false,
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
            ])
            ->add('invoiceLines',CollectionType::class,[
                'label' => false,
                'entry_type' => InvoiceLineType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
            ])
            ->add('customer', EntityType::class,[
                'class' => Customer::class,
                'choice_label' => 'name',
                'label' => 'Client',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}