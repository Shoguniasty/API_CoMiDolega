<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Polling;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Polling controller.
 *
 * @Route("admin/polling/")
 */
class PollingController extends Controller
{
    /**
     * Lists all polling entities.
     *
     * @Route("/", name="polling_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pollings = $em->getRepository('AppBundle:Polling')->findAll();

        return $this->render('polling/index.html.twig', array(
            'pollings' => $pollings,
        ));
    }

    /**
     * Creates a new polling entity.
     *
     * @Route("/new", name="polling_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $polling = new Polling();
        $form = $this->createForm('AppBundle\Form\PollingType', $polling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($polling);
            $em->flush();

            return $this->redirectToRoute('polling_show', array('id' => $polling->getId()));
        }

        return $this->render('polling/new.html.twig', array(
            'polling' => $polling,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a polling entity.
     *
     * @Route("/{id}", name="polling_show")
     * @Method("GET")
     */
    public function showAction(Polling $polling)
    {
        $deleteForm = $this->createDeleteForm($polling);

        return $this->render('polling/show.html.twig', array(
            'polling' => $polling,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing polling entity.
     *
     * @Route("/{id}/edit", name="polling_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Polling $polling)
    {
        $deleteForm = $this->createDeleteForm($polling);
        $editForm = $this->createForm('AppBundle\Form\PollingType', $polling);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('polling_edit', array('id' => $polling->getId()));
        }

        return $this->render('polling/edit.html.twig', array(
            'polling' => $polling,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a polling entity.
     *
     * @Route("/{id}", name="polling_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Polling $polling)
    {
        $form = $this->createDeleteForm($polling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($polling);
            $em->flush();
        }

        return $this->redirectToRoute('polling_index');
    }

    /**
     * Creates a form to delete a polling entity.
     *
     * @param Polling $polling The polling entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Polling $polling)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('polling_delete', array('id' => $polling->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
