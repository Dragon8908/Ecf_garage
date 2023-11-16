<?php
    
namespace App\Form;

use App\Data\FiltreData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prixmin', NumberType::class, ['label' => false,'required' => false,'attr' => ['placeholder' => 'Prix min']])
            ->add('prixmax', NumberType::class, ['label' => false,'required' => false,'attr' => ['placeholder' => 'Prix max']])
            ->add('kmmin', NumberType::class, ['label' => false,'required' => false,'attr' => ['placeholder' => 'Kilométrage min']])
            ->add('kmmax', NumberType::class, ['label' => false,'required' => false,'attr' => ['placeholder' => 'Kilométrage max']])
            ->add('anneemin', NumberType::class, ['label' => false,'required' => false,'attr' => ['placeholder' => 'Année min']])
            ->add('anneemax', NumberType::class, ['label' => false,'required' => false,'attr' => ['placeholder' => 'Année max']]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FiltreData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}