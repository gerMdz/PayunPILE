<?php

namespace App\EventSubscriber;


use App\Service\Handler\Celebracion\HandlerCelebracion;
use App\Service\Handler\DelayMail\HandlerDelayMail;
use App\Service\Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ReservaSubscriber implements EventSubscriberInterface
{

    private HandlerCelebracion $handlerCelebracion;
    private HandlerDelayMail $handlerDelayMail;
    private Mailer $mailer;
    private string $queue_enable;


    /**
     * ReservaSubscriber constructor.
     * @param HandlerCelebracion $handlerCelebracion
     * @param HandlerDelayMail $handlerDelayMail
     * @param Mailer $mailer
     * @param string $queue_enable
     */
    public function __construct(HandlerCelebracion $handlerCelebracion, HandlerDelayMail $handlerDelayMail, Mailer $mailer, string $queue_enable)
    {

        $this->handlerCelebracion = $handlerCelebracion;
        $this->handlerDelayMail = $handlerDelayMail;
        $this->mailer = $mailer;
        $this->queue_enable = $queue_enable;
    }

    public function onAnulaReservaEvent($event)
    {
        if($this->handlerCelebracion->hayLugar($event->getData())){

            try {
                $this->handlerDelayMail->grabaAvisoLugar($event->getData());
            } catch (TransportExceptionInterface $e) {
            }
        }

    }

    /**
     * @throws TransportExceptionInterface
     */
    public function onCreaReservaEvent($event)
    {

        if($this->queue_enable == 'true') {
            $this->handlerDelayMail->grabaReserva($event->getData());
        }else {
            $this->mailer->sendReservaMessage($event->getData());
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'anula.reserva.event' => 'onAnulaReservaEvent',
            'crea.reserva.event' => 'onCreaReservaEvent',
        ];
    }
}
