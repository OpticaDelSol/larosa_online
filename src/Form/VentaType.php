<?php

namespace App\Form;

use App\Entity\Venta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VentaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha')
            ->add('total')
            ->add('facturaNro')
            ->add('facturaIva')
            ->add('clienteIdcliente')
            ->add('vendedorIdvendedor')
        ;
        $builder->add("productos", CollectionType::class,
      [
        'entry_type' => ProductoType::class,
        'entry_options' => ['label' => false],
        'allow_add' => true,
      ]  
    );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Venta::class,
        ]);
    }
}
