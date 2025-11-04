<?php


namespace App\Domain\Booking\ValueObjects;


use InvalidArgumentException;


class SeatNumber
{
    public function __construct(private string $seat)
    {
        if (!preg_match('/^[A-Z]\d+$/', $seat)) {
            throw new InvalidArgumentException("Invalid seat number: {$seat}");
        }
    }


    public function value(): string
    {
        return $this->seat;
    }
}
