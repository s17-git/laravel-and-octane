<?php


namespace App\Domain\Booking\Repositories;


use App\Domain\Booking\Entities\Ticket;


interface TicketRepositoryInterface
{
    public function save(Ticket $ticket): Ticket;
    public function isSeatBooked(string $busId, string $seatNumber): bool;
    public function findById(string $id): ?Ticket;
}
