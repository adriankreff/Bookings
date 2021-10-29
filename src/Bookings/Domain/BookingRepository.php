<?php
   
   namespace App\Bookings\Domain;
      
   interface BookingRepository
   {
       public function getAll(): array;
   }