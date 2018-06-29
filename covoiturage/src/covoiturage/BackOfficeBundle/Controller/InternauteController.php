<?php

namespace covoiturage\BackOfficeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use covoiturage\BackOfficeBundle\Entity\Internaute;
use covoiturage\BackOfficeBundle\Form\InternauteType;

/**
 * Internaute controller.
 *
 */
class InternauteController extends Controller
{
    /**
     * Lists all Internaute entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $internautes = $em->getRepository('covoiturageBackOfficeBundle:Internaute')->findAll();

        return $this->render('internaute/index.html.twig', array(
            'internautes' => $internautes,
        ));
    }

    /**
     * Creates a new Internaute entity.
     *
     */
    public function newAction(Request $request)
    {
        $internaute = new Internaute();
        $form = $this->createForm('covoiturage\BackOfficeBundle\Form\InternauteType', $internaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($internaute);
            $em->flush();

            return $this->redirectToRoute('adminbo_internaute_show', array('id' => $internaute->getId()));
        }

        return $this->render('internaute/new.html.twig', array(
            'internaute' => $internaute,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Internaute entity.
     *
     */
    public function showAction(Internaute $internaute)
    {
        $deleteForm = $this->createDeleteForm($internaute);

        return $this->render('internaute/show.html.twig', array(
            'internaute' => $internaute,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Internaute entity.
     *
     */
    public function editAction(Request $request, Internaute $internaute)
    {
        $deleteForm = $this->createDeleteForm($internaute);
        $editForm = $this->createForm('covoiturage\BackOfficeBundle\Form\InternauteType', $internaute);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($internaute);
            $em->flush();

            return $this->redirectToRoute('adminbo_internaute_edit', array('id' => $internaute->getId()));
        }

        return $this->render('internaute/edit.html.twig', array(
            'internaute' => $internaute,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Internaute entity.
     *
     */
    public function deleteAction(Request $request, Internaute $internaute)
    {
        $form = $this->createDeleteForm($internaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($internaute);
            $em->flush();
        }

        return $this->redirectToRoute('adminbo_internaute_index');
    }

    /**
     * Creates a form to delete a Internaute entity.
     *
     * @param Internaute $internaute The Internaute entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Internaute $internaute)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminbo_internaute_delete', array('id' => $internaute->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
