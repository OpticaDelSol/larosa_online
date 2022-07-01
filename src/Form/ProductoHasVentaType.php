<?php

namespace App\Form;

use App\Entity\ProductoHasVenta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductoHasVentaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('modeloColorIdcolor',ChoiceType::class, ['label'=>'Modelo'])
            ->add('comision')
            ->add('precio')
            ->add('costo')
            ->add('cantidad')
            
            //->add('ventaIdventa')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductoHasVenta::class,
        ]);
    }
}
