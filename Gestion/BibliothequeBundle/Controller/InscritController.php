<?php
/**
 * Created by PhpStorm.
 * User: nguyenminhanh
 * Date: 01/06/15
 * Time: 01:12
 */

namespace Gestion\BibliothequeBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InscritController extends Controller {

    public function indexAction()
    {
        return $this->render('GestionBibliothequeBundle::inscritIndex.html.twig');
    }
}