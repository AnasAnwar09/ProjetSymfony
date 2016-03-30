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

class LivreRForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rayon', 'entity', array('class'     => 'GestionBibliothequeBundle:Rayon',
                                           'property'  => 'designation_rayon',
                                           'multiple'  => false ,
                                           'expanded'  => false))
            //->add('enregistrer', 'submit')
        ;
    }

    public function getName()
    {
        return 'livreRayon';
    }
}