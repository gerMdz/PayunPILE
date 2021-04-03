<?php

namespace App\EventSubscriber;

use App\Entity\DelayMail;
use App\Service\Handler\Celebracion\HandlerCelebracion;
use App\Service\Handler\DelayMail\HandlerDelayMail;
use App\Service\Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ReservaSubscriber implements EventSubscriberInterface
{

    private HandlerCelebracion $handlerCelebracion;
    private HandlerDelayMail $handlerDelayMail;


    /**
     * ReservaSubscriber constructor.
     * @param HandlerCelebracion $handlerCelebracion
     * @param HandlerDelayMail $handlerDelayMail
     */
    public function __construct(HandlerCelebracion $handlerCelebracion, HandlerDelayMail $handlerDelayMail)
    {

        $this->handlerCelebracion = $handlerCelebracion;
        $this->handlerDelayMail = $handlerDelayMail;
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

    public function onCreaReservaEvent($event)
    {
        $this->handlerDelayMail->grabaReserva($event->getData());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'anula.reserva.event' => 'onAnulaReservaEvent',
            'crea.reserva.event' => 'onCreaReservaEvent',
        ];
    }
}
