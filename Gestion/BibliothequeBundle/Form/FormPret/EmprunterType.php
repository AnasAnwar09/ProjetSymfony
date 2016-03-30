<?php

namespace Gestion\BibliothequeBundle\Form\FormPret;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmprunterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('exemplaire')
            ->add('lecteur')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\BibliothequeBundle\Entity\Emprunter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_bibliothequebundle_emprunter';
    }
}
