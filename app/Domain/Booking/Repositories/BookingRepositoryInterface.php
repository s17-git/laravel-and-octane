<?php


namespace App\Domain\Booking\Repositories;


use App\Domain\Booking\Entities\Booking;


interface BookingRepositoryInterface
{
    public function save(Booking $booking): Booking;
    public function findById(string $id): ?Booking;
}
