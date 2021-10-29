<?php

namespace Tests\Booking\Domain;

use App\Bookings\Domain\Booking;
use App\Bookings\Domain\BookingRepository;

final class BookingMockRepository implements BookingRepository
{    
    public function getAll(): array
    {
        $bookings = [];   

        $bookings[] = new Booking("34637","Nombre 1","2018-10-04","2018-10-05","Hotel 4","112.49","Cobrar Devolver");
        $bookings[] = new Booking("34694","Nombre 2","2018-06-15","2018-06-17","Hotel 1","427.77","Cobrar");
        $bookings[] = new Booking("34611","Nombre 3","2018-06-11","2018-06-12","Hotel 4","1100","Cobrar");
        $bookings[] = new Booking("34603","Nombre 4","2018-08-15","2018-08-17","Hotel 3","212.22","Cobrar Devolver");

        return $bookings;
    }  

}
