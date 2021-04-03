<?php

namespace App\Controller;

use App\Entity\QueueTransport;
use App\Form\QueueTransportType;
use App\Repository\QueueTransportRepository;
use App\Service\Handler\DelayMail\HandlerDelayMail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class QueueTransportController extends AbstractController
{
    /**
     * @Route("/delay/{hashkey}/transport", name="queue_transport_delay", methods={"GET"})
     */
    public function delaytransport(QueueTransportRepository $queueTransportRepository, Request $request, HandlerDelayMail $handlerDelayMail): Response
    {
        $haskey = $request->get('hashkey');
        $qt = $queueTransportRepository->findBy(['hashkey'=> $haskey]);
        $fueron = 0;
        $entityManager = $this->getDoctrine()->getManager();

        /** @var QueueTransport $qt */
        if(!$qt[0]->getIsBlock()){

            $qt[0]->setIsBlock(true);
            $entityManager->persist($qt[0]);
            $entityManager->flush();

            $qt[0]->setInicioAt(new \DateTime());
            $fueron = $handlerDelayMail->enviaMail();
            $qt[0]->setFinalAt(new \DateTime());
            $qt[0]->setIsBlock(false);
            $entityManager->persist($qt[0]);
            $entityManager->flush();
        }
        return $this->render('queue_transport/respuesta.html.twig', [
            'fueron' => $fueron,
        ]);
    }

    /**
     * @Route("/admin/queuetransport/list", name="queue_transport_index", methods={"GET"})
     */
    public function index(QueueTransportRepository $queueTransportRepository): Response
    {
        return $this->render('queue_transport/index.html.twig', [
            'queue_transports' => $queueTransportRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/queuetransport/new", name="queue_transport_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $queueTransport = new QueueTransport();
        $form = $this->createForm(QueueTransportType::class, $queueTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($queueTransport);
            $entityManager->flush();

            return $this->redirectToRoute('queue_transport_index');
        }

        return $this->render('queue_transport/new.html.twig', [
            'queue_transport' => $queueTransport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/queuetransport/{id}", name="queue_transport_show", methods={"GET"})
     */
    public function show(QueueTransport $queueTransport): Response
    {
        return $this->render('queue_transport/show.html.twig', [
            'queue_transport' => $queueTransport,
        ]);
    }

    /**
     * @Route("/admin/queuetransport/{id}/edit", name="queue_transport_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, QueueTransport $queueTransport): Response
    {
        $form = $this->createForm(QueueTransportType::class, $queueTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('queue_transport_index');
        }

        return $this->render('queue_transport/edit.html.twig', [
            'queue_transport' => $queueTransport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/queuetransport/{id}", name="queue_transport_delete", methods={"DELETE"})
     */
    public function delete(Request $request, QueueTransport $queueTransport): Response
    {
        if ($this->isCsrfTokenValid('delete'.$queueTransport->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($queueTransport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('queue_transport_index');
    }
}
