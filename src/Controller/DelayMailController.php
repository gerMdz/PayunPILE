<?php

namespace App\Controller;

use App\Entity\DelayMail;
use App\Form\DelayMailType;
use App\Repository\DelayMailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/delay/mail")
 */
class DelayMailController extends AbstractController
{
    /**
     * @Route("/", name="delay_mail_index", methods={"GET"})
     */
    public function index(DelayMailRepository $delayMailRepository): Response
    {
        return $this->render('delay_mail/index.html.twig', [
            'delay_mails' => $delayMailRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="delay_mail_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $delayMail = new DelayMail();
        $form = $this->createForm(DelayMailType::class, $delayMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($delayMail);
            $entityManager->flush();

            return $this->redirectToRoute('delay_mail_index');
        }

        return $this->render('delay_mail/new.html.twig', [
            'delay_mail' => $delayMail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delay_mail_show", methods={"GET"})
     */
    public function show(DelayMail $delayMail): Response
    {
        return $this->render('delay_mail/show.html.twig', [
            'delay_mail' => $delayMail,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="delay_mail_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DelayMail $delayMail): Response
    {
        $form = $this->createForm(DelayMailType::class, $delayMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('delay_mail_index');
        }

        return $this->render('delay_mail/edit.html.twig', [
            'delay_mail' => $delayMail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delay_mail_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DelayMail $delayMail): Response
    {
        if ($this->isCsrfTokenValid('delete'.$delayMail->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($delayMail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('delay_mail_index');
    }
}
