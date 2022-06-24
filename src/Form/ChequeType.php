<?php

namespace App\Form;

use App\Entity\Cheque;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChequeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('bancoIdbanco')
            ->add('clienteIdcliente')
            ->add('cobroModoPagoIdcobroModoPago')
            ->add('vendedorIdvendedor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cheque::class,
        ]);
    }
}
