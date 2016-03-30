<?php

namespace Gestion\BibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Gestion\BibliothequeBundle\Entity\Etagere;
use Symfony\Component\HttpFoundation\Request;
use Gestion\BibliothequeBundle\Form\FormMagasinier\EtagereForm;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EtagereController extends Controller
{
//lister les etageres
    public function listerAction()
    {
        $em = $this->getDoctrine()->getManager();

        $etageres = $em->getRepository('GestionBibliothequeBundle:Etagere')->findAll();

        return $this->render('GestionBibliothequeBundle:Etagere:lister.html.twig', array('etageres' => $etageres));
    }

    //Ajouter un etagere
    public function ajouterAction()
    {
        $message = '';
        //création du form
        $etagere = new etagere();
        $form = $this->createForm(new EtagereForm, $etagere);
        //validation du form
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($etagere);
                $em->flush();
                $message = 'Etagere ajouté avec succès !';
            }
        }

        return $this->render('GestionBibliothequeBundle:Etagere:ajouter.html.twig',
            array('form' => $form->createView(), 'message' => $message));
    }

    //supprimer etagere si vide
    public function supprimerAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $etagere = $em->find('GestionBibliothequeBundle:Etagere', $id);

        if (!$etagere) {
            throw new NotFoundHttpException("etagere non trouvé");
        }
        $exemplaire = $etagere->getExemplairesRanges();
        $nombreE = count($exemplaire);

        if ($nombreE == 0) {

            $em->remove($etagere);
            $em->flush();

            $url = $this->generateUrl('gestion_etagere_lister');
            return $this->redirect($url);

        } else {


            $request->getSession()->getFlashBag()->add('notice', 'ATTENTION ETAGERE N EST PAS VIDE !!');
            $url = $this->generateUrl('gestion_etagere_lister');
            return $this->redirect($url);


        }

    }
}
