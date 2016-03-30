<?php
/**
 * Created by PhpStorm.
 * User: nguyenminhanh
 * Date: 07/06/15
 * Time: 12:23
 */

namespace Gestion\BibliothequeBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class ConservateurController extends Controller {

    public function indexAction()
    {
        return $this->render('GestionBibliothequeBundle::conservateurIndex.html.twig');
    }

}