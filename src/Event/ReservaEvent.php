<?php


namespace App\Event;


use Symfony\Contracts\EventDispatcher\Event;

class ReservaEvent extends Event
{
    public const ANULA_RESERVA = 'anula.reserva.event';
    public const CREA_RESERVA = 'crea.reserva.event';

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}