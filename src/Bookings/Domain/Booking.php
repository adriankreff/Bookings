<?php

declare(strict_types=1);

namespace App\Bookings\Domain;

use Exception;

final class Booking
{
    private $locator;
    private $guest;
    private $entryDate;
    private $departureDate;
    private $hotel;
    private $price;
    private $possibleActions;

    public function __construct(string $locator, string  $guest, string   $entryDate, string  $departureDate, string  $hotel, string  $price, string  $possibleActions)
    {
        $this->locator          =  $locator;
        $this->guest            =  $guest;
        $this->entryDate        =  $entryDate;
        $this->departureDate    =  $departureDate;
        $this->hotel            =  $hotel;
        $this->price            =  $price;
        $this->possibleActions  =  $possibleActions;
    }

    public static function fromPrimitives(array $primitives): Booking
    {
        return new self($primitives[0], $primitives[1], $primitives[2], $primitives[3], $primitives[4], $primitives[5], $primitives[6]);
    }

    public function toPrimitives()
    {
        return [
            'locator'           => $this->locator,
            'guest'             => $this->guest,
            'entryDate'         => $this->entryDate,
            'departureDate'     => $this->departureDate,
            'hotel'             => $this->hotel,
            'price'             => $this->price,
            'possibleActions'   => $this->possibleActions
        ];
    }

    public function locator(): string
    {
        return $this->locator;
    }

    public function guest(): string
    {
        return $this->guest;
    }

    public function entryDate(): string
    {
        return $this->entryDate;
    }

    public function departureDate(): string
    {
        return $this->departureDate;
    }

    public function hotel(): string
    {
        return $this->hotel;
    }

    public function price(): string
    {
        return $this->price;
    }

    public function possibleActions(): string
    {
        return $this->possibleActions;
    }
}
