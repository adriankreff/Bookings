<?php

declare(strict_types=1);

namespace App\Bookings\Repository;

use App\Bookings\Domain\Booking;
use App\Bookings\Domain\BookingRepository;

final class BookingJsonRepository implements BookingRepository
{
    private const BOOKINGS_URL_DOWNLOAD = "http://tech-test.wamdev.net/";
    private const BOOKINGS_SEPARATOR = "\n";

    public function getAll(): array
    {

        $dowloadedCSV = file_get_contents(self::BOOKINGS_URL_DOWNLOAD);

        $rows = str_getcsv($dowloadedCSV, self::BOOKINGS_SEPARATOR);

        $bookings = [];

        foreach ($rows as $row) {
            $line = str_getcsv($row, ";");
            if (count($line) == 7)
                $bookings[] = Booking::fromPrimitives($line);
        }

        return $bookings;
    }

  

}
