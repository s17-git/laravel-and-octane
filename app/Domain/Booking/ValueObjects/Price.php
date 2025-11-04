<?php


namespace App\Domain\Booking\ValueObjects;


use InvalidArgumentException;


class Price
{
    public function __construct(private float $amount)
    {
        if ($amount < 0) throw new InvalidArgumentException('Price cannot be negative');
    }


    public function value(): float
    {
        return $this->amount;
    }
}
