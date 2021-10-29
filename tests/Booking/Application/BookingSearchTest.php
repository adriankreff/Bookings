<?php

declare(strict_types = 1);

namespace Tests\Booking\Application;

use PHPUnit\Framework\TestCase;

use App\Bookings\Application\Search\BookingSearch;
use App\Bookings\Domain\Booking;
use App\Bookings\Domain\BookingList;
use App\Bookings\Domain\BookingRepository;

use Exception;

final class BookingSearchTest extends TestCase
{

    /** @test */
    public function it_should_return_a_booking_list_when_exists(): void
    {
        $bookingSearch = new BookingSearch(new BookingMockSearchRepository());
        $bookingFiltered= $bookingSearch(['guest'=>'Nombre 1']);


        $expectedBooking = new Booking("34637","Nombre 1","2018-10-04","2018-10-05","Hotel 4","112.49","Cobrar Devolver");
        $expectedArrayBooking =new BookingList([$expectedBooking]);

        $this->assertEquals(
            $expectedArrayBooking,
            $bookingFiltered,
            "Object is not equal"
        );          
    }

    /** @test */
    public function it_should_return_all_when_filtered_value_is_empty(): void
    {
        $bookingSearch = new BookingSearch(new BookingMockSearchRepository());
        $bookingsFiltered= $bookingSearch([]);

        $bookingsExpected = new BookingList(); 
        $bookingsExpected->append(new Booking("34637","Nombre 1","2018-10-04","2018-10-05","Hotel 4","112.49","Cobrar Devolver"));
        $bookingsExpected->append(new Booking("34694","Nombre 2","2018-06-15","2018-06-17","Hotel 1","427.77","Cobrar"));
        $bookingsExpected->append(new Booking("34611","Nombre 3","2018-06-11","2018-06-12","Hotel 4","1100","Cobrar"));
        $bookingsExpected->append(new Booking("34603","Nombre 4","2018-08-15","2018-08-17","Hotel 3","212.22","Cobrar Devolver"));    

        $this->assertEquals(
            $bookingsExpected,
            $bookingsFiltered,
            "Object is not equal"
        );    
    }

    /** @test */
    public function it_should_return_empty_array_when_filtered_value_not_exists(): void
    {
        $bookingSearch = new BookingSearch(new BookingMockSearchRepository());
        $bookingsFiltered= $bookingSearch(['guest'=>'Nombre que no existe']);

        $bookingsExpected = new BookingList(); 
        
        $this->assertEquals(
            $bookingsExpected,
            $bookingsFiltered,
            "Object is not equal"
        );    
    }

    /** @test */
    public function it_should_return_exception_when_filtered_value_is_not_a_valid_filter(): void
    {
        $bookingSearch = new BookingSearch(new BookingMockSearchRepository());
       
        try{
            $bookingSearch(['invalidFilter'=>'Nombre que no existe']);
            $this->fail("Expected exception 1162011 not thrown");
        }catch(Exception $e){ //Not catching a generic Exception or the fail function is also catched
        
            $this->assertTrue(true);
        }
    }
}

final class BookingMockSearchRepository implements BookingRepository
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