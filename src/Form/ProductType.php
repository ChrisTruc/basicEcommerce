<?php

namespace App\Form;

use App\Entity\TypeProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductType extends AbstractType
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextAreaType::class)
            ->add('price', IntegerType::class)
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));

        $builder->add('save', SubmitType::class , ['label' => 'Enregistrer']);
    }

    function onPreSetData(FormEvent $event) {
        $form = $event->getForm();

        $typeProductRep = $this->em->getRepository('App\Entity\TypeProduct');

        $typeProducts = $typeProductRep->createQueryBuilder("q")
                ->getQuery()
                ->getResult();

        $form->add('typeProduct', EntityType::class, array(
            'required' => true,
            'placeholder' => '-- Choisir le type de produit --',
            'class' => TypeProduct::class,
            'choices' => $typeProducts
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
