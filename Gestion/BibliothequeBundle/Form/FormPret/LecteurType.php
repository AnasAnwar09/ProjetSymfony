<?php

namespace Gestion\BibliothequeBundle\Form\FormPret;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LecteurType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    protected $name;
    public function __construct($name = 'lecteurtype')
    {
        $this->name = 'Gestion_BibliothequeBundle'.$name;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('NomLecteur', 'entity',
            array ('label' => 'Nom du Lecteur',
                'class' => 'GestionBibliothequeBundle:Lecteur',
                'property' => 'nomLecteur',
                'required' => true
                ))
                ;

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\BibliothequeBundle\Entity\Lecteur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
