<?php

namespace Gestion\BibliothequeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\BibliothequeBundle\Entity\Livre;
use Gestion\BibliothequeBundle\Form\FormConservateur\LivreType;

/**
 * Livre controller.
 *
 */

class LivreController extends Controller
{

    /**
     * Lists all Livre entities.
     *
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        //$form = $this->retourFormRechercheAction();
        $entities = $em->getRepository('GestionBibliothequeBundle:Livre')->findAll();

        return $this->render('GestionBibliothequeBundle:Livre:index.html.twig', array(
            'entities' => $entities,
           // 'form'=> $form->createView()
        ));
    }
  /*  public function retourFormRechercheAction(){

        $livre = new Livre();
        $form = $this->createForm(new RechercheType(), $livre, array('action'=>$this->generateUrl('livre_recherche')));
        $form->add('submit','submit', array('label' => 'rechercher' ));

        return $form;

    }*/
    public function rechercherAction(Request $request)
    {
//        if(isset($request->get('motrecherche'))){
//
//        }

        if( $request->getMethod() == 'POST' ) {
            $entityManager = $this->getDoctrine()->getManager();
            $repository = $entityManager->getRepository('GestionBibliothequeBundle:Auteur');
            $repository1 = $entityManager->getRepository('GestionBibliothequeBundle:Livre');
            $repository2 = $entityManager->getRepository('GestionBibliothequeBundle:Theme');

            $mot = $request->get('motrecherche');
            $livres = $request->get('motrecherche1');
            $themes = $request->get('motrecherche2');

            $listeMots = $repository->findByNomAuteur($mot);
            $listeLivre = $repository1->findByTitreLivre($livres);
            $listeLivreParTheme = $repository2->findByDescriptionTheme($themes);


            return $this->render('GestionBibliothequeBundle:Livre:test.html.twig',
                array('listeMots' => $listeMots,
                        'listeLivre' =>$listeLivre ,
                        'listeLivreParTheme' => $listeLivreParTheme
                ));

        }
    }
  /*  public function rechercheAction(){
    var_dump('test');
        exit;

    }*/
    /**
     * Creates a new Livre entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Livre();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('livre_show', array('id' => $entity->getId())));
        }

        return $this->render('GestionBibliothequeBundle:Livre:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Livre entity.
     *
     * @param Livre $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Livre $entity)
    {
        $form = $this->createForm(new LivreType(), $entity, array(
            'action' => $this->generateUrl('livre_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Livre entity.
     *
     */
    public function newAction()
    {
        $entity = new Livre();
        $form   = $this->createCreateForm($entity);

        return $this->render('GestionBibliothequeBundle:Livre:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Livre entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBibliothequeBundle:Livre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Livre entity.');
        }
        $auteurs = $entity->getAuteur();
        $themes = $entity->getThemeLivre();
        $nombreTheme = count($themes);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionBibliothequeBundle:Livre:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'themes' => $themes,
            'auteurs' => $auteurs,
            'nombreTheme' => $nombreTheme,
        ));
    }

    /**
     * Displays a form to edit an existing Livre entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBibliothequeBundle:Livre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Livre entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionBibliothequeBundle:Livre:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Livre entity.
    *
    * @param Livre $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Livre $entity)
    {
        $form = $this->createForm(new LivreType(), $entity, array(
            'action' => $this->generateUrl('livre_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Livre entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBibliothequeBundle:Livre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Livre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('livre_edit', array('id' => $id)));
        }

        return $this->render('GestionBibliothequeBundle:Livre:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Livre entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionBibliothequeBundle:Livre')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Livre entity.');
            }
            $exemplaireLivre = $entity->getExemplaires();
            $lecteur = $entity->getReserver();
            $nombreLecteur = count($lecteur);
            $nombreExemplaire = count($exemplaireLivre);
            //
            if ($nombreExemplaire == 0 && $nombreLecteur == 0) {
                $em->remove($entity);
                $em->flush();
                $url = $this->generateUrl('livre');
                return $this->redirect($url);
            } elseif ($nombreExemplaire != 0) {
                $request->getSession()->getFlashBag()->add('notice', 'ATTENTION : ce livre à déja des exemplaire dans la bibliothèque ');
                $url = $this->generateUrl('livre');
                return $this->redirect($url);
            } elseif ($nombreLecteur != 0) {
                $request->getSession()->getFlashBag()->add('notice', 'ATTENTION : ce livre est déja emprunter à un lecteur ');
                $url = $this->generateUrl('livre');
                return $this->redirect($url);
            }

        }
        return $this->redirect($this->generateUrl('livre'));
    }

    /**
     * Creates a form to delete a Livre entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('livre_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }



    //fonctions créées par Hussam
    //lister les livres
    public function listerEtagereAction()
    {
        $em = $this->getDoctrine()->getManager();

        $livres = $em->getRepository('GestionBibliothequeBundle:Livre')->findAll();

        return $this->render('GestionBibliothequeBundle:Livre:listerEtagere.html.twig', array('livres' => $livres));
    }

    public function listerRayonAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rayons = $em->getRepository('GestionBibliothequeBundle:Rayon')->findAll();

        return $this->render('GestionBibliothequeBundle:Rayon:lister.html.twig', array('rayons' => $rayons));
    }
}
