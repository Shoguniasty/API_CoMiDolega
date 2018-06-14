<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DiseaseSymptoms;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Diseasesymptoms controller.
 *
 * @Route("diseasesymptoms")
 */
class DiseaseSymptomsController extends Controller
{
    /**
     * Lists all diseaseSymptom entities.
     *
     * @Route("/", name="diseasesymptoms_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $diseaseSymptoms = $em->getRepository('AppBundle:DiseaseSymptoms')->findAll();

        return $this->render('diseasesymptoms/index.html.twig', array(
            'diseaseSymptoms' => $diseaseSymptoms,
        ));
    }

    /**
     * Creates a new diseaseSymptom entity.
     *
     * @Route("/new", name="diseasesymptoms_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $diseaseSymptom = new DiseaseSymptoms();
        $form = $this->createForm('AppBundle\Form\DiseaseSymptomsType', $diseaseSymptom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($diseaseSymptom);
            $em->flush();

            return $this->redirectToRoute('diseasesymptoms_show', array('id' => $diseaseSymptom->getId()));
        }

        return $this->render('diseasesymptoms/new.html.twig', array(
            'diseaseSymptom' => $diseaseSymptom,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a diseaseSymptom entity.
     *
     * @Route("/{id}", name="diseasesymptoms_show")
     * @Method("GET")
     */
    public function showAction(DiseaseSymptoms $diseaseSymptom)
    {
        $deleteForm = $this->createDeleteForm($diseaseSymptom);

        return $this->render('diseasesymptoms/show.html.twig', array(
            'diseaseSymptom' => $diseaseSymptom,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing diseaseSymptom entity.
     *
     * @Route("/{id}/edit", name="diseasesymptoms_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DiseaseSymptoms $diseaseSymptom)
    {
        $deleteForm = $this->createDeleteForm($diseaseSymptom);
        $editForm = $this->createForm('AppBundle\Form\DiseaseSymptomsType', $diseaseSymptom);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('diseasesymptoms_edit', array('id' => $diseaseSymptom->getId()));
        }

        return $this->render('diseasesymptoms/edit.html.twig', array(
            'diseaseSymptom' => $diseaseSymptom,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a diseaseSymptom entity.
     *
     * @Route("/{id}", name="diseasesymptoms_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DiseaseSymptoms $diseaseSymptom)
    {
        $form = $this->createDeleteForm($diseaseSymptom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($diseaseSymptom);
            $em->flush();
        }

        return $this->redirectToRoute('diseasesymptoms_index');
    }

    /**
     * Creates a form to delete a diseaseSymptom entity.
     *
     * @param DiseaseSymptoms $diseaseSymptom The diseaseSymptom entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DiseaseSymptoms $diseaseSymptom)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('diseasesymptoms_delete', array('id' => $diseaseSymptom->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
