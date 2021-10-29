<?php

declare(strict_types=1);

namespace App\Bookings\Domain;

use ArrayObject;
use Exception;

final class BookingList extends ArrayObject
{
   
    public function toPrimitives()
    {   
        $bookingsInArray=[];

        foreach($this as $booking){
            $bookingsInArray[]=$booking->toPrimitives();
        }
        
        return $bookingsInArray;
    }

}
