<?php

declare(strict_types=1);

namespace App\Bookings\Application\Search;

use App\Bookings\Domain\BookingRepository;
use App\Bookings\Domain\Filters;
use App\Bookings\Domain\Booking;
use App\Bookings\Domain\BookingList;
use Exception;

final class BookingSearch
{
    private $_repository;

    public function __construct(BookingRepository $repository)
    {
        $this->_repository = $repository;
    }

    public function __invoke(array $filters): BookingList
    {

        $allBookings = $this->_repository->getAll();

        $bookings = new BookingList($this->searchByFilters($allBookings, $filters));
        return $bookings;
    }

    private function searchByFilters(array $bookings, array $arrayfilters): array
    {

        $filters = Filters::fromPrimitives($arrayfilters);
        $validFilters = $filters->toValidArray();

        return array_filter($bookings, function ($booking) use ($validFilters) {
            foreach ($validFilters as $filterKey => $filterValue) {
                if (!str_contains($booking->$filterKey(), $filterValue))
                    return false;
            }
            return true;
        });
    }
}
