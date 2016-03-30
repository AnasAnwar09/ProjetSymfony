<?php

namespace Gestion\BibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Gestion\BibliothequeBundle\Entity\Rayon;
use Symfony\Component\HttpFoundation\Request;
use Gestion\BibliothequeBundle\Form\FormMagasinier\RayonForm;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RayonController extends Controller
{
//lister les rayons
    public function listerAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rayons = $em->getRepository('GestionBibliothequeBundle:Rayon')->findAll();

        return $this->render('GestionBibliothequeBundle:Rayon:lister.html.twig', array('rayons' => $rayons));
    }

    //Ajouter un rayon
    public function ajouterAction()
    {
        $message = '';
        //création du form
        $rayon = new rayon();
        $form = $this->createForm(new RayonForm, $rayon);
        //validation du form
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($rayon);
                $em->flush();
                $message = 'Rayon ajouté avec succès !';
            }
        }

        return $this->render('GestionBibliothequeBundle:Rayon:ajouter.html.twig',
            array('form' => $form->createView(), 'message' => $message));
    }

    //supprimer rayon si vide
    public function supprimerAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rayon = $em->find('GestionBibliothequeBundle:Rayon', $id);

        if (!$rayon) {
            throw new NotFoundHttpException("rayon non trouvé");
        }
        $etagere = $rayon->getEtageres();
        $nombreE = count($etagere);

        if ($nombreE == 0 ) {

            $em->remove($rayon);
            $em->flush();
            $url = $this->generateUrl('gestion_rayon_lister');
            return $this->redirect($url);
        }
        else {

            $request->getSession()->getFlashBag()->add('notice', 'ATTENTION RAYON N EST PAS VIDE !!');
            $url = $this->generateUrl('gestion_rayon_lister');
            return $this->redirect($url);
        }

        //$em->remove($rayon);
        //$em->flush();

        //$url = $this->generateUrl('gestion_rayon_lister');

    }
}
