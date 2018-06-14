<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Symptoms;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Symptom controller.
 *
 * @Route("admin/symptoms")
 */
class SymptomsController extends Controller
{
    /**
     * Lists all symptom entities.
     *
     * @Route("/", name="symptoms_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $symptoms = $em->getRepository('AppBundle:Symptoms')->findAll();

        return $this->render('symptoms/index.html.twig', array(
            'symptoms' => $symptoms,
        ));
    }

    /**
     * Creates a new symptom entity.
     *
     * @Route("/new", name="symptoms_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $symptom = new Symptoms();
        $form = $this->createForm('AppBundle\Form\SymptomsType', $symptom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($symptom);
            $em->flush();

            return $this->redirectToRoute('symptoms_show', array('id' => $symptom->getId()));
        }

        return $this->render('symptoms/new.html.twig', array(
            'symptom' => $symptom,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a symptom entity.
     *
     * @Route("/{id}", name="symptoms_show")
     * @Method("GET")
     */
    public function showAction(Symptoms $symptom)
    {
        $deleteForm = $this->createDeleteForm($symptom);

        return $this->render('symptoms/show.html.twig', array(
            'symptom' => $symptom,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing symptom entity.
     *
     * @Route("/{id}/edit", name="symptoms_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Symptoms $symptom)
    {
        $deleteForm = $this->createDeleteForm($symptom);
        $editForm = $this->createForm('AppBundle\Form\SymptomsType', $symptom);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('symptoms_edit', array('id' => $symptom->getId()));
        }

        return $this->render('symptoms/edit.html.twig', array(
            'symptom' => $symptom,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a symptom entity.
     *
     * @Route("/{id}", name="symptoms_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Symptoms $symptom)
    {
        $form = $this->createDeleteForm($symptom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($symptom);
            $em->flush();
        }

        return $this->redirectToRoute('symptoms_index');
    }

    /**
     * Creates a form to delete a symptom entity.
     *
     * @param Symptoms $symptom The symptom entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Symptoms $symptom)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('symptoms_delete', array('id' => $symptom->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
