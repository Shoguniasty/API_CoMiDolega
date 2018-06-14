<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Diseases;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Disease controller.
 *
 * @Route("diseases")
 */
class DiseasesController extends Controller
{
    /**
     * Lists all disease entities.
     *
     * @Route("/", name="diseases_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $diseases = $em->getRepository('AppBundle:Diseases')->findAll();

        return $this->render('diseases/index.html.twig', array(
            'diseases' => $diseases,
        ));
    }

    /**
     * Creates a new disease entity.
     *
     * @Route("/new", name="diseases_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $disease = new Diseases();
        $form = $this->createForm('AppBundle\Form\DiseasesType', $disease);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($disease);
            $em->flush();

            return $this->redirectToRoute('diseases_show', array('id' => $disease->getId()));
        }

        return $this->render('diseases/new.html.twig', array(
            'disease' => $disease,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a disease entity.
     *
     * @Route("/{id}", name="diseases_show")
     * @Method("GET")
     */
    public function showAction(Diseases $disease)
    {
        $deleteForm = $this->createDeleteForm($disease);

        return $this->render('diseases/show.html.twig', array(
            'disease' => $disease,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing disease entity.
     *
     * @Route("/{id}/edit", name="diseases_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Diseases $disease)
    {
        $deleteForm = $this->createDeleteForm($disease);
        $editForm = $this->createForm('AppBundle\Form\DiseasesType', $disease);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('diseases_edit', array('id' => $disease->getId()));
        }

        return $this->render('diseases/edit.html.twig', array(
            'disease' => $disease,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a disease entity.
     *
     * @Route("/{id}", name="diseases_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Diseases $disease)
    {
        $form = $this->createDeleteForm($disease);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($disease);
            $em->flush();
        }

        return $this->redirectToRoute('diseases_index');
    }

    /**
     * Creates a form to delete a disease entity.
     *
     * @param Diseases $disease The disease entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Diseases $disease)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('diseases_delete', array('id' => $disease->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
