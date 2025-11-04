<?php


namespace App\Application\Booking\Commands;


class ReserveTicketCommand
{
    public function __construct(
        public string $busId,
        public string $userId,
        public string $seatNumber,
        public string $passengerName,
        public float $price,
        public ?string $idempotencyKey = null
    ) {}
}
