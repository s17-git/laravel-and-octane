<?php


namespace App\Domain\Booking\Entities;


use App\Domain\Booking\Entities\Ticket;


class Booking
{
    public function __construct(
        public string $id,
        public Ticket $ticket,
        public string $status = 'reserved'
    ) {}
}
