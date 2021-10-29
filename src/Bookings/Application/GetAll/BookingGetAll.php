<?php

declare(strict_types=1);

namespace App\Bookings\Application\GetAll;

use App\Bookings\Domain\BookingRepository;

final class BookingGetAll
{
    private $_repository;

    public function __construct(BookingRepository $repository)
    {
        $this->_repository= $repository;
    }

    public function __invoke(): array
    {   
       return $this->_repository->getAll();
    }
}