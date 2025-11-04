<?php
namespace App\Application\Booking\Data;

use Spatie\LaravelData\Data;
use App\Domain\Booking\Entities\Ticket;

class TicketData extends Data
{
    public function __construct(
        public string $id,
        public string $busId,
        public string $userId,
        public string $seatNumber,
        public string $passengerName,
        public float $price,
        public ?string $idempotency_key = null,

    ) {}

    public static function fromEntity(Ticket $ticket): self
    {
        return new self(
            (string) ($ticket->id ?? ''),
            $ticket->busId,
            $ticket->userId,
            $ticket->seatNumber()->value(),
            $ticket->passengerName()->value(),
            $ticket->price()->value()
        );
    }
}