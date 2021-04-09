<?php

namespace App\Controller;

use App\Entity\CuerpoMail;
use App\Form\CuerpoMailType;
use App\Repository\CuerpoMailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cuerpomail")
 */
class CuerpoMailController extends AbstractController
{
    /**
     * @Route("/", name="cuerpo_mail_index", methods={"GET"})
     * @param CuerpoMailRepository $cuerpoMailRepository
     * @return Response
     */
    public function index(CuerpoMailRepository $cuerpoMailRepository): Response
    {
        return $this->render('cuerpo_mail/index.html.twig', [
            'cuerpo_mails' => $cuerpoMailRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cuerpo_mail_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $cuerpoMail = new CuerpoMail();
        $form = $this->createForm(CuerpoMailType::class, $cuerpoMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cuerpoMail);
            $entityManager->flush();

            return $this->redirectToRoute('cuerpo_mail_index');
        }

        return $this->render('cuerpo_mail/new.html.twig', [
            'cuerpo_mail' => $cuerpoMail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cuerpo_mail_show", methods={"GET"})
     * @param CuerpoMail $cuerpoMail
     * @return Response
     */
    public function show(CuerpoMail $cuerpoMail): Response
    {
        return $this->render('cuerpo_mail/show.html.twig', [
            'cuerpo_mail' => $cuerpoMail,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cuerpo_mail_edit", methods={"GET","POST"})
     * @param Request $request
     * @param CuerpoMail $cuerpoMail
     * @return Response
     */
    public function edit(Request $request, CuerpoMail $cuerpoMail): Response
    {
        $form = $this->createForm(CuerpoMailType::class, $cuerpoMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cuerpo_mail_index');
        }

        return $this->render('cuerpo_mail/edit.html.twig', [
            'cuerpo_mail' => $cuerpoMail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cuerpo_mail_delete", methods={"DELETE"})
     * @param Request $request
     * @param CuerpoMail $cuerpoMail
     * @return Response
     */
    public function delete(Request $request, CuerpoMail $cuerpoMail): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cuerpoMail->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cuerpoMail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cuerpo_mail_index');
    }
}
