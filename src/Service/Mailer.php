<?php

namespace App\Service;


use App\Entity\Celebracion;
use App\Entity\Invitado;
use App\Entity\Reservante;
use App\Entity\WaitingList;
use App\Repository\InvitadoRepository;
use App\Repository\WaitingListRepository;
use App\Service\Handler\Metabase\HandlerMetabase;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Twig\Environment;

class Mailer
{
    private MailerInterface $mailer;
    private Environment $twig;
    private WaitingListRepository $waitingListRepository;
    private InvitadoRepository $repository;
    private HandlerMetabase $handlerMetabase;


    /**
     * Mailer constructor.
     * @param MailerInterface $mailer
     * @param Environment $twig
     * @param WaitingListRepository $waitingListRepository
     * @param InvitadoRepository $repository
     * @param HandlerMetabase $handlerMetabase
     */
    public function __construct(MailerInterface $mailer, Environment $twig, WaitingListRepository $waitingListRepository, InvitadoRepository $repository, HandlerMetabase $handlerMetabase)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->waitingListRepository = $waitingListRepository;
        $this->repository = $repository;
        $this->handlerMetabase = $handlerMetabase;
    }

    /**
     * @param Reservante $reservante
     * @return TemplatedEmail
     * @throws TransportExceptionInterface
     */
    public function sendReservaMessage(Reservante $reservante): TemplatedEmail
    {

        $invitados = $this->repository->count(['enlace' => $reservante->getId()]);

        $email = (new TemplatedEmail())
            ->from(new Address($this->handlerMetabase->metadatos()->getEmailBase(), $this->handlerMetabase->metadatos()->getSiteName()))
            ->to(new Address($reservante->getEmail(), $reservante->getNombre()))
            ->subject('Confirmación de reserva')
            ->htmlTemplate('email/reserva.html.twig')
            ->context([
                'reservante' => $reservante,
                'invitados' => $invitados,
                'base' => $this->handlerMetabase->metadatos()
            ]);

        $this->mailer->send($email);

        return $email;
    }

    /**
     * @param WaitingList $espera
     * @return TemplatedEmail
     * @throws TransportExceptionInterface
     */
    public function sendAvisoRegistroReservaMessage(WaitingList $espera): TemplatedEmail
    {
        $email = (new TemplatedEmail())
            ->from(new Address($this->handlerMetabase->metadatos()->getEmailBase(), $this->handlerMetabase->metadatos()->getSiteName()))
            ->to(new Address($espera->getEmail(), $espera->getNombre()))
            ->subject('Confirmación registro aviso de disponibilidad ')
            ->htmlTemplate('email/avisoRegistro.html.twig')
            ->context([
                // You can pass whatever data you want
                'espera' => $espera,
                'base' => $this->handlerMetabase->metadatos()
            ]);

        $this->mailer->send($email);

        return $email;
    }

    /**
     * @param Celebracion $celebracion
     * @return bool
     * @throws TransportExceptionInterface
     */
    public function sendAvisoLugarMessage(Celebracion $celebracion): bool
    {

        $esperan = $celebracion->getWaitingLists();

        foreach ($esperan as $espera) {

            $email = (new TemplatedEmail())
                ->from(new Address($this->handlerMetabase->metadatos()->getEmailBase(), $this->handlerMetabase->metadatos()->getSiteName()))
                ->to(new Address($espera->getEmail(), $espera->getNombre()))
                ->subject('Aviso de disponibilidad')
                ->htmlTemplate('email/avisoLugar.html.twig')
                ->context([
                    // You can pass whatever data you want
                    'espera' => $espera,
                    'celebracion' => $celebracion,
                    'base' => $this->handlerMetabase->metadatos()
                ]);

            $this->mailer->send($email);
            sleep(30);
        }

        return true;
    }

    public function sendReservaInvitadoMessage(Invitado $reservante): TemplatedEmail
    {
        $email = (new TemplatedEmail())
            ->from(new Address($this->handlerMetabase->metadatos()->getEmailBase(), $this->handlerMetabase->metadatos()->getSiteName()))
            ->to($reservante->getEmail())
            ->subject('Confirmación de reserva')
            ->htmlTemplate('email/reserva_invitado.html.twig')
            ->context([
                // You can pass whatever data you want
                'reservante' => $reservante,
                'base' => $this->handlerMetabase->metadatos()
            ]);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
        }

        return $email;
    }
}
