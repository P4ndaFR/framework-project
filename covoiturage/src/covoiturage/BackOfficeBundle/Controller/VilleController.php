<?php

namespace covoiturage\BackOfficeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use covoiturage\BackOfficeBundle\Entity\Ville;
use covoiturage\BackOfficeBundle\Form\VilleType;

/**
 * Ville controller.
 *
 */
class VilleController extends Controller
{
    /**
     * Lists all Ville entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villes = $em->getRepository('covoiturageBackOfficeBundle:Ville')->findAll();

        return $this->render('ville/index.html.twig', array(
            'villes' => $villes,
        ));
    }

    /**
     * Creates a new Ville entity.
     *
     */
    public function newAction(Request $request)
    {
        $ville = new Ville();
        $form = $this->createForm('covoiturage\BackOfficeBundle\Form\VilleType', $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();

            return $this->redirectToRoute('ville_show', array('id' => $ville->getId()));
        }

        return $this->render('ville/new.html.twig', array(
            'ville' => $ville,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Ville entity.
     *
     */
    public function showAction(Ville $ville)
    {
        $deleteForm = $this->createDeleteForm($ville);

        return $this->render('ville/show.html.twig', array(
            'ville' => $ville,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ville entity.
     *
     */
    public function editAction(Request $request, Ville $ville)
    {
        $deleteForm = $this->createDeleteForm($ville);
        $editForm = $this->createForm('covoiturage\BackOfficeBundle\Form\VilleType', $ville);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();

            return $this->redirectToRoute('ville_edit', array('id' => $ville->getId()));
        }

        return $this->render('ville/edit.html.twig', array(
            'ville' => $ville,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Ville entity.
     *
     */
    public function deleteAction(Request $request, Ville $ville)
    {
        $form = $this->createDeleteForm($ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ville);
            $em->flush();
        }

        return $this->redirectToRoute('ville_index');
    }

    /**
     * Creates a form to delete a Ville entity.
     *
     * @param Ville $ville The Ville entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ville $ville)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ville_delete', array('id' => $ville->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
