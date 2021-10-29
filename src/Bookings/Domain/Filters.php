<?php

declare(strict_types=1);

namespace App\Bookings\Domain;

use Exception;

final class Filters
{
    private $locator;
    private $guest;
    private $entryDate;
    private $departureDate;
    private $hotel;
    private $price;
    private $possibleActions;

    public function __construct(string $locator, string  $guest, string  $entryDate, string  $departureDate, string  $hotel, string  $price, string  $possibleActions)
    {
        $this->locator          =  $locator;
        $this->guest            =  $guest;
        $this->entryDate        =  $entryDate;
        $this->departureDate    =  $departureDate;
        $this->hotel            =  $hotel;
        $this->price            =  $price;
        $this->possibleActions  =  $possibleActions;
    }

    public static function fromPrimitives(array $filters): Filters
    {
        return new self(
            (isset($filters['locator']) && $filters['locator'] != "") ? $filters['locator'] : "",
            (isset($filters['guest']) && $filters['guest'] != "") ? $filters['guest'] : "",
            (isset($filters['entryDate']) && $filters['entryDate'] != "") ? $filters['entryDate'] : "",
            (isset($filters['departureDate']) && $filters['departureDate'] != "") ? $filters['departureDate'] : "",
            (isset($filters['hotel']) && $filters['hotel'] != "") ? $filters['hotel'] : "",
            (isset($filters['price']) && $filters['price'] != "") ? $filters['price'] : "",
            (isset($filters['possibleActions']) && $filters['possibleActions'] != "") ? $filters['possibleActions'] : ""
        );
    }

    public function toValidArray()
    {
        $filtersArray = [];

        if ($this->locator != "")
            $filtersArray['locator'] = $this->locator;

        if ($this->guest != "")
            $filtersArray['guest'] = $this->guest;

        if ($this->entryDate != "")
            $filtersArray['entryDate'] = $this->entryDate;

        if ($this->departureDate != "")
            $filtersArray['departureDate'] = $this->departureDate;

        if ($this->hotel != "")
            $filtersArray['hotel'] = $this->hotel;

        if ($this->price != "")
            $filtersArray['price'] = $this->price;

        if ($this->possibleActions != "")
            $filtersArray['possibleActions'] = $this->possibleActions;

        return $filtersArray;
    }
}
