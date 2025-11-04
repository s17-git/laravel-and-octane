<?php


namespace App\Domain\Booking\ValueObjects;


use InvalidArgumentException;


class PassengerName
{
    public function __construct(private string $name)
    {
        $name = trim($name);
        if ($name === '') throw new InvalidArgumentException('Passenger name cannot be empty');
    }


    public function value(): string
    {
        return $this->name;
    }
}
