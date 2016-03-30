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

class ExemplaireForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroExemplaire', 'text')
            ->add('livre', 'entity', array('class'       => 'GestionBibliothequeBundle:Livre',
                                           'property'    => 'titre_livre',
                                           'multiple'    => false ,
                                           'expanded'    => false))
            ->add('etagere', 'entity', array('class'     => 'GestionBibliothequeBundle:Etagere',
                                             'property'    => 'numero_etagere',
                                             'multiple'    => false ,
                                             'expanded'    => false))

            //->add('enregistrer', 'submit')
        ;
    }

    public function getName()
    {
        return 'exemplaire';
    }
}