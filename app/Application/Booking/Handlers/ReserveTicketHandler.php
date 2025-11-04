<?php


namespace App\Application\Booking\Handlers;

use App\Application\Booking\Commands\ReserveTicketCommand;
use App\Application\Booking\Data\TicketData;
use App\Domain\Booking\Services\BookingService;


class ReserveTicketHandler
{
    public function __construct(private BookingService $bookingService) {}


    public function handle(ReserveTicketCommand $command): TicketData
    {
        $ticket = $this->bookingService->reserveTicket(
            $command->busId,
            $command->userId,
            $command->seatNumber,
            $command->passengerName,
            $command->price,
            $command->idempotencyKey
        );

        // 3) publish domain event(s) — could be synchronous or queued
        // event(new \App\Domain\Payment\Events\MoneyTransferred($transfer->toArray()));

        return TicketData::fromEntity($ticket);
    }
}
