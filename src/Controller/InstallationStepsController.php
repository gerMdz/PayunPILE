<?php

namespace App\Controller;

use App\Entity\InstallationSteps;
use App\Form\InstallationStepsType;
use App\Repository\InstallationStepsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/installation/steps")
 */
class InstallationStepsController extends AbstractController
{
    /**
     * @Route("/", name="installation_steps_index", methods={"GET"})
     */
    public function index(InstallationStepsRepository $installationStepsRepository): Response
    {
        return $this->render('installation_steps/index.html.twig', [
            'installation_steps' => $installationStepsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="installation_steps_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $installationStep = new InstallationSteps();
        $form = $this->createForm(InstallationStepsType::class, $installationStep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($installationStep);
            $entityManager->flush();

            return $this->redirectToRoute('installation_steps_index');
        }

        return $this->render('installation_steps/new.html.twig', [
            'installation_step' => $installationStep,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="installation_steps_show", methods={"GET"})
     */
    public function show(InstallationSteps $installationStep): Response
    {
        return $this->render('installation_steps/show.html.twig', [
            'installation_step' => $installationStep,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="installation_steps_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InstallationSteps $installationStep): Response
    {
        $form = $this->createForm(InstallationStepsType::class, $installationStep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('installation_steps_index');
        }

        return $this->render('installation_steps/edit.html.twig', [
            'installation_step' => $installationStep,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="installation_steps_delete", methods={"POST"})
     */
    public function delete(Request $request, InstallationSteps $installationStep): Response
    {
        if ($this->isCsrfTokenValid('delete'.$installationStep->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($installationStep);
            $entityManager->flush();
        }

        return $this->redirectToRoute('installation_steps_index');
    }
}
