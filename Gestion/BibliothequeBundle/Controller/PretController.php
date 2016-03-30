<?php
/**
 * Created by PhpStorm.
 * User: nguyenminhanh
 * Date: 26/04/15
 * Time: 23:51
 */

namespace Gestion\BibliothequeBundle\Controller;

use Gestion\BibliothequeBundle\Entity\Archivage;
use Gestion\BibliothequeBundle\Entity\Emprunter;
use Gestion\BibliothequeBundle\Entity\ExemplaireRepository;
use Gestion\BibliothequeBundle\Entity\Lecteur;
use Gestion\BibliothequeBundle\Entity\Livre;
use Gestion\BibliothequeBundle\Entity\LivreRepository;
use Gestion\BibliothequeBundle\Entity\Reserver;
use Gestion\BibliothequeBundle\Form\FormPret\EmprunterType;
use Gestion\BibliothequeBundle\Form\FormPret\LecteurType;
use Gestion\BibliothequeBundle\Form\FormPret\LivreType;
use Proxies\__CG__\Gestion\BibliothequeBundle\Entity\Exemplaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

class PretController extends Controller {

    public function indexAction()
    {
        return $this->render('GestionBibliothequeBundle:AgentPret:index.html.twig');
    }
//----------------------------------------------------------------------------------------------------------
    //--Fonction qui renvoie la liste globale des prêts + 2 formulaires de tris par Lecteur ou par Livre

    public function listePretGlobalAction()
    {
        $request = $this->get('request');
        $em =  $this->getDoctrine()->getManager();
        //-- Parcourir toute la table emprunter
        $emprunter = $em->getRepository('GestionBibliothequeBundle:Emprunter')->findAll();

        $lecteur = new Lecteur();
        $livre   = new Livre();

        //-- Créer le formulaire pour le tri par Lecteur
        $formLivre = $this->createForm(new LivreType(),$livre);


        $formLecteur = $this->createForm( new LecteurType(),$lecteur);

        return $this->render('GestionBibliothequeBundle:AgentPret:listePretGlobal.html.twig',
                            array('emprunter'=>$emprunter));

    }
//----------------------------------------------------------------------------------------------------------
    //--Fonction qui renvoie la liste globale des prêts + 2 formulaires de tris par Lecteur ou par Livre

    public function listeReservationAction()
    {
        $request = $this->get('request');
        $em =  $this->getDoctrine()->getManager();
        //-- Parcourir toute la table reserver
        $reserver = $em->getRepository('GestionBibliothequeBundle:Reserver')->findAll();

        return $this->render('GestionBibliothequeBundle:AgentPret:listeReservation.html.twig',
            array('reserver'=>$reserver));

    }
//----------------------------------------------------------------------------------------------------------
    public function trierParLecteurAction(Request $request)
    {
        //$request = $this->container->get('request');

        if($request->isXmlHttpRequest()) {
            $nomLecteur = $request->request->get('motcle');
            $repository = $this->getDoctrine()->getManager()
                ->getRepository('GestionBibliothequeBundle:Lecteur');
            $lecteur = $repository->FindByName($nomLecteur);
            $repository = $this->getDoctrine()->getManager()
                ->getRepository('GestionBibliothequeBundle:Emprunter');
            $emprunterPL = $repository->FindByEmprunteur($lecteur);


            return $this->render('GestionBibliothequeBundle:AgentPret:listePretParLecteur.html.twig',
                array('emprunterPL' => $emprunterPL
                ));
        }
        else
            throw new \Exception('Erreur');



    }
 //----------------------------------------------------------------------------------------------------------
    public function trierParLivreAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {

            $titreLivre = $request->request->get('motcle');
            $tLDecode = urldecode($titreLivre);
            echo($titreLivre);
            die($tLDecode);
            $repository = $this->getDoctrine()->getManager()
                    ->getRepository('GestionBibliothequeBundle:Livre');
            $livre = $repository->FindOneBy(array('titreLivre'=>$tLDecode));

            return $this->render('GestionBibliothequeBundle:AgentPret:listePretParLivre.html.twig',
                    array('livre' => $livre));
       }
        else
            throw new \Exception('Erreur');
    }
 //----------------------------------------------------------------------------------------------------------
    public function listerParLivreAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {

            $titreLivre = $request->request->get('motcle');
            $tLDecode = urldecode($titreLivre);


            $repository = $this->getDoctrine()->getManager()
                ->getRepository('GestionBibliothequeBundle:Livre');
            $livre = $repository->FindOneBy(array('titreLivre' => $tLDecode));

            $listExemplaire = $livre->getExemplaires();


            return $this->render('GestionBibliothequeBundle:AgentPret:listePretParLivre.html.twig',
                array('listExemplaire' => $listExemplaire));
        }
        else
            throw new \Exception('Erreur');
    }
  //----------------------------------------------------------------------------------------------------------
    public function ListerHorsDelaisAction(Request $request)
    {
        if($request->isXmlHttpRequest()){
            $repository = $this->getDoctrine()->getManager()->getRepository('GestionBibliothequeBundle:Emprunter');
            $emprunter = $repository->FindHorsDelais();
            return $this->render('GestionBibliothequeBundle:AgentPret:listePretHorsDelais.html.twig',
                array('emprunterHD' => $emprunter));
        }
    }
    //----------------------------------------------------------------------------------------------------------
    public function consulterDispoAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            //--Vérifier si le livre possède des exemplaires disponibles au pret
            $dispo = false;
            $nombreEmprunter = 0;
            $titreLivre = $request->request->get('motcle');
            $tLDecode = urldecode($titreLivre);

            $repository = $this->getDoctrine()->getManager()
                ->getRepository('GestionBibliothequeBundle:Livre');
            $livre = $repository->FindOneBy(array('titreLivre' => $tLDecode));

            $id = $livre->getId();

            $listExemplaire = $livre->getExemplaires();
            $nombreExemplaire = count($listExemplaire);

            $repository = $this->getDoctrine()->getManager()
                ->getRepository('GestionBibliothequeBundle:Emprunter');
            foreach ($listExemplaire as $exemplaire) {
                $emprunter = $repository->FindOneBy(array('exemplaire' => $exemplaire));
                if ($emprunter != null) {
                    $nombreEmprunter++;
                    $listExemplaire->removeElement($exemplaire);
                }


            }
            $listExemplaireReserv = $livre->getReserver();
            $nombreRestant1 = count($listExemplaire);

            $nombreRestant = $nombreExemplaire - $nombreEmprunter;
            $nombreExemplaireReserv = count($listExemplaireReserv);
            $nombreDispo  = $nombreRestant - $nombreExemplaireReserv;

            //S'il y a des exemplaires disponibles
            if ($nombreRestant > $nombreExemplaireReserv)
            {
                $form = $this->EnregistrerPretAction($id,$nombreDispo, $request);
                return $this->render('GestionBibliothequeBundle:AgentPret:enregistrementPret.html.twig',
                    array('formPret' => $form->createView()));

            }
            else
            {
                //Sinon, proposer un formulaire de réservation
                $form = $this->EnregistrerReserverAction($id,$request);
                return $this->render('GestionBibliothequeBundle:AgentPret:enregistrementReserver.html.twig',
                array('formReserver' => $form->createView()));
            }
        }
    }
//----------------------------------------------------------------------------------------------------------
    public function SortieLivreAction()
    {
        $livre = new Livre();
        $form = $this->createForm(new LivreType(), $livre,
                            array('action'=>$this->generateUrl('gestion_bibliotheque_consulterDispo')));
        $form->add('submit','submit', array('label'=>'Vérifier Disponibilité'));

        return $this->render('GestionBibliothequeBundle:AgentPret:sortieDeLivre.html.twig',
                            array('form'=>$form->createView()));
    }
    //----------------------------------------------------------------------------------------------------------
    public function EnregistrerPretAction($id, $nombreDispo, Request $request)
    {
        $emprunter = new Emprunter();
        $form = $this->createFormBuilder($emprunter,array('action'=>$this->generateUrl
                                                    ('gestion_bibliotheque_enregistrerPret'
                                                    ,array('id'=>$id,'nombreDispo'=>$nombreDispo))))
            ->add('exemplaire', 'entity', array(
                'class' => 'Gestion\BibliothequeBundle\Entity\Exemplaire',
                'query_builder' => function(ExemplaireRepository $er ) use ( $id, $nombreDispo ) {
                    return $er->FindByLivre($id, $nombreDispo);

                },
                'required'  => true
            ))
            ->add('emprunteur', 'entity',
                array ('label' => 'Nom du Lecteur',
                    'class' => 'GestionBibliothequeBundle:Lecteur',
                    'property' => 'nomLecteur',
                    'required' => true
                ))
            ->add('dateDebut','date',array('required' => false,
                'widget' =>'single_text',
                'format'=>'yyyy-MM-dd'
            ))

            ->add('submit','submit',array('label'=>'Enregistrer Pret'))
            ->getForm();
        $form->handleRequest($request);
        //--Requete Ajax, on retourne seulement le formulaire
        if($request->isXmlHttpRequest())
            return $form;
        //-On effectue la requete
        if($request->isMethod('POST') || $request->isMethod('GET')) {
            $entityManager = $this->getDoctrine()->getManager();

            $lecteur = $emprunter->getEmprunteur();
            $quota  = $this->CheckQuotaLecteur($lecteur);
            if($quota == true) {
                $cycleLecteur = $lecteur->getCycleLecteur();
                $date = new \DateTime();
                switch($cycleLecteur)
                {
                    case 1:
                        $dateFin = $date->modify('+15 day');
                        $emprunter->setDateFin($dateFin);
                        break;
                    case 2:
                        $dateFin = $date->modify('+15 day');
                        $emprunter->setDateFin($dateFin);
                        break;
                    case 3:
                        $emprunter->setDateFin('yyyy-MM-dd');
                        break;

                }
                $entityManager->persist($emprunter);
                $entityManager->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Pret bien enregistrée.');
                $url = $this->generateUrl('gestion_bibliotheque_listepret',
                    array('emprunter' => $emprunter));
                return $this->redirect($url);
            }
            else
            {
                $request->getSession()->getFlashBag()->add('notice', 'Quota de prêt dépassé pour'.' '.
                                        $lecteur->getNomLecteur().' '.$lecteur->getPrenomLecteur().'. '.
                                        'Cycle d\'étude :'.' '.$lecteur->getCycleLecteur().'. '.
                                        'Nombre d\'emprunts en cours :'.count($lecteur->getEmprunter()).' livres')
                                        ;
                $url = $this->generateUrl('gestion_bibliotheque_sortieLivre');
                return $this->redirect($url);

            }

        }
    }
    //----------------------------------------------------------------------------------------------------------
    public function CheckQuotaLecteur(Lecteur $lecteur)
    {
        $quota = true;

        $cycleLecteur = $lecteur->getCycleLecteur();
        $emprunter   = $lecteur->getEmprunter();
        $nombreEmprunt = count($emprunter);

        switch($cycleLecteur)
        {
            case 1:
                if($nombreEmprunt >= 5)
                   $quota = false;
                break;
            case 2:
                if($nombreEmprunt >= 10)
                    $quota = false;
                break;
            case 3:
                if($nombreEmprunt >=15)
                    $quota = false;
                break;
        }

        return $quota;
    }
    //----------------------------------------------------------------------------------------------------------
    public function EnregistrerReserverAction($id, Request $request)
    {
        $reserver = new Reserver();
        $form = $this->createFormBuilder($reserver,array('action'=>$this->generateUrl
                                             ('gestion_bibliotheque_enregistrerReserver',array('id'=>$id))))
            ->add('livre', 'entity', array(
                'class' => 'Gestion\BibliothequeBundle\Entity\Livre',
                'query_builder' => function(LivreRepository $er ) use ( $id ) {
                    return $er->FindById($id);

                },
                'required'  => true
            ))
            ->add('lecteur', 'entity',
                array ('label' => 'Nom du Lecteur',
                    'class' => 'GestionBibliothequeBundle:Lecteur',
                    'property' => 'nomLecteur',
                    'required' => true
                ))
            ->add('dateReservation','date',array('required' => false,
                'widget' =>'single_text',
                'format'=>'yyyy-MM-dd'
            ))

            ->add('submit','submit',array('label'=>'Enregistrer Réservation'))
            ->getForm();
        $form->handleRequest($request);
        if($request->isXmlHttpRequest())
            return $form;
        //-On effectue la requete
        if($request->isMethod('POST') || $request->isMethod('GET')) {
            $entityManager = $this->getDoctrine()->getManager();

                $entityManager->persist($reserver);
                $entityManager->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Reservation bien enregistrée.');
                $url = $this->generateUrl('gestion_bibliotheque_listereservation',
                    array('reserver' => $reserver));
                return $this->redirect($url);
        }

    }
    //----------------------------------------------------------------------------------------------------------
    public function FormulaireRetourLivreAction()
    {
        $lecteur = new Lecteur();
        $form = $this->createForm(new LecteurType(), $lecteur,
            array('action'=>$this->generateUrl('gestion_bibliotheque_listePretRetour')));
        $form->add('submit','submit', array('label'=>'Lister Pret'));

        return $this->render('GestionBibliothequeBundle:AgentPret:retourDeLivre.html.twig',
            array('form'=>$form->createView()));
    }
    //----------------------------------------------------------------------------------------------------------
    public function consulterListePretAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $nomLecteur = $request->request->get('motcle');
            $repository = $this->getDoctrine()->getManager()
                ->getRepository('GestionBibliothequeBundle:Lecteur');
            $lecteur = $repository->FindByName($nomLecteur);
            $repository = $this->getDoctrine()->getManager()
                ->getRepository('GestionBibliothequeBundle:Emprunter');
            $emprunterPL = $repository->FindByEmprunteur($lecteur);


            return $this->render('GestionBibliothequeBundle:AgentPret:listePretParLecteurRetour.html.twig',
                array('emprunterPL' => $emprunterPL
                ));

        }

    }
    //----------------------------------------------------------------------------------------------------------
    public function SupprimerEmpruntAction(Request $request)
    {
        if($request->isXmlHttpRequest()) {
            $numeroEmprunt = $request->request->get('motcle');
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('GestionBibliothequeBundle:Emprunter');
            $emprunt = $repository->find($numeroEmprunt);
            $lecteur = $emprunt->getEmprunteur();
            $exemplaire = $emprunt->getExemplaire();
            $idLecteur = $lecteur->getId();
            $idExemplaire = $exemplaire->getId();
            $date = new \DateTime();
            $archivage = new Archivage();

            $archivage->setIdExemplaire($idExemplaire);
            $archivage->setIdLecteur($idLecteur);
            $archivage->setDateRetour($date);
            $em->persist($archivage);
            $em->remove($emprunt);
            $em->flush();
            return new Response('Retour effectué. Appuyez de nouveau sur le bouton Lister Pret pour controller');

        }
    }
}
