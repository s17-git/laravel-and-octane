<?php


namespace App\Domain\Booking\Entities;


use App\Domain\Booking\ValueObjects\SeatNumber;
use App\Domain\Booking\ValueObjects\PassengerName;
use App\Domain\Booking\ValueObjects\Price;


class Ticket
{
    public ?string $id = null;


    public function __construct(
        public string $busId,
        public string $userId,
        private SeatNumber $seatNumber,
        private PassengerName $passengerName,
        private Price $price
    ) {}


    public function seatNumber(): SeatNumber
    {
        return $this->seatNumber;
    }
    public function passengerName(): PassengerName
    {
        return $this->passengerName;
    }
    public function price(): Price
    {
        return $this->price;
    }
}
