<?php

namespace Gestion\BibliothequeBundle\Form\FormPret;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LivreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    protected $name;
    public function __construct($name = 'livrertype')
    {
        $this->name = 'Gestion_BibliothequeBundle'.$name;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('TitreLivre', 'entity',
                array ('label' => 'Livre',
                    'class' => 'GestionBibliothequeBundle:Livre',
                    'property' => 'titreLivre',
                    'required' => true
                ));

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\BibliothequeBundle\Entity\Livre'
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
