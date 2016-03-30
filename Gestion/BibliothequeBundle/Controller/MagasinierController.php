<?php
/**
 * Created by PhpStorm.
 * User: nguyenminhanh
 * Date: 31/05/15
 * Time: 23:20
 */

namespace Gestion\BibliothequeBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MagasinierController extends Controller {

    public function indexAction()
    {
        return $this->render('GestionBibliothequeBundle::magasinierIndex.html.twig');
    }

}