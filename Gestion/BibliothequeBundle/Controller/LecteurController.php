<?php

namespace Gestion\BibliothequeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\BibliothequeBundle\Entity\Lecteur;
use Gestion\BibliothequeBundle\Form\FormInscription\LecteurType;

/**
 * Lecteur controller.
 *
 */
class LecteurController extends Controller
{

    /**
     * Lists all Lecteur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionBibliothequeBundle:Lecteur')->findAll();

        return $this->render('GestionBibliothequeBundle:Lecteur:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Lecteur entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Lecteur();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lecteur_show', array('id' => $entity->getId())));
        }

        return $this->render('GestionBibliothequeBundle:Lecteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Lecteur entity.
     *
     * @param Lecteur $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Lecteur $entity)
    {
        $form = $this->createForm(new LecteurType(), $entity, array(
            'action' => $this->generateUrl('lecteur_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Lecteur entity.
     *
     */
    public function newAction()
    {
        $entity = new Lecteur();
        $form   = $this->createCreateForm($entity);

        return $this->render('GestionBibliothequeBundle:Lecteur:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Lecteur entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBibliothequeBundle:Lecteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lecteur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionBibliothequeBundle:Lecteur:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Lecteur entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBibliothequeBundle:Lecteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lecteur entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionBibliothequeBundle:Lecteur:edit.html.twig', array(
            'entity'      => $entity,
            'editForm'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Lecteur entity.
    *
    * @param Lecteur $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Lecteur $entity)
    {
        $form = $this->createForm(new LecteurType(), $entity, array(
            'action' => $this->generateUrl('lecteur_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Lecteur entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBibliothequeBundle:Lecteur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lecteur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('lecteur_edit', array('id' => $id)));
        }

        return $this->render('GestionBibliothequeBundle:Lecteur:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Lecteur entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionBibliothequeBundle:Lecteur')->find($id);
            $emprunt = $entity->getEmprunter();

            $reservation = $entity->getReserver();
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Lecteur entity.');
            }

            if(count($emprunt) == 0 || count($reservation) ==0 || $entity == null || $reservation ==null)
            {

            $em->remove($entity);
            $em->flush();
            }
            else{

                $request->getSession()->getFlashBag()->add('notice',' Ce lecteur à une reservation ou un emprunt!!');
                $url = $this->generateUrl('lecteur');

                return $this->redirect($url);
                //throw new \Exception('ce lecteur à une reservation ou un emprunt');
                //throw new Exception("ce lecteur à une reservation ou un emprunt", 1);
                
            }            

        }

        return $this->redirect($this->generateUrl('lecteur'));
    }

    /**
     * Creates a form to delete a Lecteur entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lecteur_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function situationAction($id) { 
           $entityManager = $this->getDoctrine()->getManager(); 
           $lecteur = $entityManager->getRepository('GestionBibliothequeBundle:Lecteur')
                    ->find($id);
            $emprunter = $lecteur->getEmprunter();
            $reserver =  $lecteur->getReserver(); 
           return $this->render('GestionBibliothequeBundle:Lecteur:situation.html.twig',array('emprunter'=>$emprunter,
                                        'reserver'=>$reserver,
                                        'lecteur'=>$lecteur)); 
    }

  /*  public function ReserverAction(){

    }*/

 /*   public function test40Action() { 
       $entityManager = $this->getDoctrine()->getManager(); 
       $repositoryLogiciel = $entityManager->getRepository('QcmSalleTpBundle:Logiciel'); 
       $logiciel = $repositoryLogiciel->findOneByNom('Firefox'); 
       foreach ($logiciel->getMachineInstallees() as $ordi) 
         \Doctrine\Common\Util\Debug::dump($ordi->getIp());  
       return new Response('<html><body></body></html>'); 
    } */
}
