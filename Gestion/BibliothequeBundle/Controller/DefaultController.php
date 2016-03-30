<?php

namespace Gestion\BibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GestionBibliothequeBundle:Default:index.html.twig');
    }
}
