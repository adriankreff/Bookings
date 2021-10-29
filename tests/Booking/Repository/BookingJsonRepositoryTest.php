<?php

declare(strict_types = 1);

namespace Tests\Bookings\Repository;

use PHPUnit\Framework\TestCase;
use App\Bookings\Repository\BookingJsonRepository;

final class BookingGetAllTest extends TestCase
{
    /** @test */
    public function it_should_return_an_array(): void
    {
        $bookingRepository= new BookingJsonRepository();

        $bookings= $bookingRepository->getAll();

        $this->assertIsArray($bookings,'El repositorio no devuelve un array');        
    }

    /** @test */
    public function it_should_return_an_array_with_info(): void
    {
        $bookingRepository= new BookingJsonRepository();

        $bookings= $bookingRepository->getAll();
        
        $this->assertNotEmpty($bookings,'El array no tiene informacion');
    }
}