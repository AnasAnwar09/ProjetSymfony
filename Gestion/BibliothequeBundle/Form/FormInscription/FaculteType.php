<?php

namespace Gestion\BibliothequeBundle\Form\FormInscription;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FaculteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designationFaculte')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\BibliothequeBundle\Entity\Faculte'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestion_bibliothequebundle_faculte';
    }
}
