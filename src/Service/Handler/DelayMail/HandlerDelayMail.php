<?php


namespace App\Service\Handler\DelayMail;


use App\Entity\Celebracion;
use App\Entity\DelayMail;
use App\Entity\Invitado;
use App\Entity\Reservante;
use App\Entity\WaitingList;
use App\Repository\CelebracionRepository;
use App\Repository\DelayMailRepository;
use App\Repository\InvitadoRepository;
use App\Repository\ReservanteRepository;
use App\Service\Mailer;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class HandlerDelayMail
{

    const TEMPLATE_LUGAR = 'avisoLugar.html.twig';
    const TEMPLATE_REGISTRO = 'avisoRegistro.html.twig';
    const TEMPLATE_RESERVA = 'reserva.html.twig';
    const TEMPLATE_RESERVA_INVITADO = 'reserva_invitado.html.twig';

    private DelayMailRepository $delayMailRepository;
    private ReservanteRepository $reservanteRepository;
    private InvitadoRepository $invitadoRepository;
    private EntityManagerInterface $em;
    private Mailer $mailer;

    /**
     * HandlerCelebracion constructor.
     * @param DelayMailRepository $delayMailRepository
     * @param ReservanteRepository $reservanteRepository
     * @param InvitadoRepository $invitadoRepository
     * @param EntityManagerInterface $em
     * @param Mailer $mailer
     */
    public function __construct(DelayMailRepository $delayMailRepository, ReservanteRepository $reservanteRepository, InvitadoRepository $invitadoRepository, EntityManagerInterface $em, Mailer $mailer)
{

    $this->delayMailRepository = $delayMailRepository;
    $this->reservanteRepository = $reservanteRepository;
    $this->invitadoRepository = $invitadoRepository;
    $this->em = $em;
    $this->mailer = $mailer;
}

    /**
     * @param Reservante $reservante
     */
    public function grabaReserva(Reservante $reservante):void
    {
        $delay_mail = new DelayMail();
        $delay_mail->setEmail($reservante->getEmail());
        $delay_mail->setTemplate(self::TEMPLATE_RESERVA);
        $delay_mail->setPrioridad(1);
        $delay_mail->setEntity($reservante->getId());
        $this->em->persist($delay_mail);
        $this->em->flush();
    }

    /**
     * @param Celebracion $celebracion
     * @return WaitingList[]|Collection
     */
    public function theWaitingList(Celebracion $celebracion)
    {
        return $celebracion->getWaitingLists();
    }

    /**
     * @param Celebracion $celebracion
     * @return Invitado[]|Collection
     */
    public function theInvitadosList(Celebracion $celebracion)
    {
        return $celebracion->getInvitados();
    }

    /**
     * @param Celebracion $celebracion
     * @return array
     */
    public function theInvitadosEmail(Celebracion $celebracion): array
    {
        $invitados = [];

        foreach($celebracion->getInvitados() as $invitado ){
            array_push($invitado, $invitado->getEmail());
        }
            return $invitados;

    }

    public function enviaMail()
    {

        $delayMail = $this->delayMailRepository->findDelayMail();

        foreach ($delayMail as $dm){

            $reservante = $this->reservanteRepository->find($dm->getEntity());
            try {
                $this->mailer->sendReservaMessage($reservante);
                $this->em->remove($dm);
                $this->em->flush();
            } catch (TransportExceptionInterface $e) {
            }
        }
    }



}