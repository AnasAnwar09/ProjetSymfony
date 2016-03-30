<?php
/**
 * Created by PhpStorm.
 * User: houssamazrarh
 * Date: 09/05/15
 * Time: 14:57
 */

namespace Gestion\BibliothequeBundle\Form\FormMagasinier;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RayonForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designationRayon', 'text')
            ->add('theme_rayon', 'entity', array('class'     => 'GestionBibliothequeBundle:Theme',
                                                 'property'  => 'description_theme',
                                                 'multiple'  => false ,
                                                 'expanded'  => false))
            //->add('enregistrer', 'submit')
        ;
    }

    public function getName()
    {
        return 'rayon';
    }
}