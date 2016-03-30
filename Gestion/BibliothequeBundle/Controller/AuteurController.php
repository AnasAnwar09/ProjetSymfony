<?php

namespace Gestion\BibliothequeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\BibliothequeBundle\Entity\Auteur;
use Gestion\BibliothequeBundle\Form\FormConservateur\AuteurType;

/**
 * Auteur controller.
 *
 */
class AuteurController extends Controller
{

    /**
     * Lists all Auteur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionBibliothequeBundle:Auteur')->findAll();

        return $this->render('GestionBibliothequeBundle:Auteur:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Auteur entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Auteur();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('auteur_show', array('id' => $entity->getId())));
        }

        return $this->render('GestionBibliothequeBundle:Auteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Auteur entity.
     *
     * @param Auteur $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Auteur $entity)
    {
        $form = $this->createForm(new AuteurType(), $entity, array(
            'action' => $this->generateUrl('auteur_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Auteur entity.
     *
     */
    public function newAction()
    {
        $entity = new Auteur();
        $form   = $this->createCreateForm($entity);

        return $this->render('GestionBibliothequeBundle:Auteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Auteur entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBibliothequeBundle:Auteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auteur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionBibliothequeBundle:Auteur:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Auteur entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBibliothequeBundle:Auteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auteur entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionBibliothequeBundle:Auteur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Auteur entity.
    *
    * @param Auteur $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Auteur $entity)
    {
        $form = $this->createForm(new AuteurType(), $entity, array(
            'action' => $this->generateUrl('auteur_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Auteur entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBibliothequeBundle:Auteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auteur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('auteur_edit', array('id' => $id)));
        }

        return $this->render('GestionBibliothequeBundle:Auteur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Auteur entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionBibliothequeBundle:Auteur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Auteur entity.');
            }
            $livre = $entity->getLivresEcrits();
            $nombreLivre = count($livre);
            if ($nombreLivre == 0){
                $em->remove($entity);
                $em->flush();
                $url = $this->generateUrl('auteur');
                return $this->redirect($url);
            }else{
                $request->getSession()->getFlashBag()->add('notice', 'ATTENTION : cet auteur à déja des livres dans la bibliothèque  !!');
                $url = $this->generateUrl('auteur');
                return $this->redirect($url);
            }

        }

        return $this->redirect($this->generateUrl('auteur'));
    }

    /**
     * Creates a form to delete a Auteur entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('auteur_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}