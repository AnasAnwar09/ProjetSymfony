<?php

namespace Gestion\BibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Gestion\BibliothequeBundle\Entity\Exemplaire;
use Symfony\Component\HttpFoundation\Request;
use Gestion\BibliothequeBundle\Form\FormMagasinier\ExemplaireForm;
use Gestion\BibliothequeBundle\Form\FormMagasinier\LivreEForm;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExemplaireController extends Controller
{
//lister les exemplaires
    public function listerAction()
    {
        $em = $this->getDoctrine()->getManager();

        $exemplaires = $em->getRepository('GestionBibliothequeBundle:Exemplaire')->findAll();

        return $this->render('GestionBibliothequeBundle:Exemplaire:lister.html.twig', array('exemplaires' => $exemplaires));
    }

    //Ajouter un exemplaire
    public function ajouterAction()
    {
        $message = '';
        //création du form
        $exemplaire = new exemplaire();
        $form = $this->createForm(new ExemplaireForm, $exemplaire);
        //validation du form
        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($exemplaire);
                $em->flush();
                $message = 'Exemplaire ajouté avec succès !';
            }
        }

        return $this->render('GestionBibliothequeBundle:Exemplaire:editer.html.twig',
            array('form' => $form->createView(), 'message' => $message));
    }

    //supprimer les exemplaires
    public function supprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $exemplaire = $em->find('GestionBibliothequeBundle:Exemplaire', $id);

        if (!$exemplaire) {
            throw new NotFoundHttpException("exemplaire non trouvé");
        }

        $em->remove($exemplaire);
        $em->flush();

        $url = $this->generateUrl('gestion_exemplaire_lister');
        return $this->redirect($url);
    }

    //editer les exemplaires (modifier)
    public function editerAction($id = null)
    {
        $message = '';
        $em = $this->getDoctrine()->getManager();

        if (isset($id)) {
            // modification d'un exemplaire existant : on recherche ses données
            $exemplaire = $em->find('GestionBibliothequeBundle:Exemplaire', $id);

            if (!$exemplaire) {
                $message = 'Aucune exemplaire trouvé';
            }
        } else {
            // ajout d'une nouvelle exemplaire
            $exemplaire = new Exemplaire();
        }

        $form = $this->createForm(new ExemplaireForm, $exemplaire);

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->persist($exemplaire);
                $em->flush();
                if (isset($id)) {
                    $message = 'Exemplaire modifié avec succès !';
                } else {
                    $message = 'Exemplaire ajouté avec succès !';
                }
            }
        }

        return $this->render('GestionBibliothequeBundle:exemplaire:editer.html.twig',
            array('form' => $form->createView(), 'message' => $message,));
    }

    public function listerEtagereAction()
    {
        $em = $this->getDoctrine()->getManager();

        $exemplaires = $em->getRepository('GestionBibliothequeBundle:Exemplaire')->findAll();

        return $this->render('GestionBibliothequeBundle:Livre:listerEtagere.html.twig', array('exemplaires' => $exemplaires));
    }
}
