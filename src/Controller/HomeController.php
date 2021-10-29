<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Bookings\Domain\BookingRepository;
use App\Bookings\Application\GetAll\BookingGetAll;
use App\Bookings\Application\Search\BookingSearch;

use Symfony\Component\Serializer\SerializerInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

final class HomeController extends AbstractController
{
    private $_bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->_bookingRepository = $bookingRepository;
    }

    public function index(): Response
    {
        $bookingGetAll = new BookingGetAll($this->_bookingRepository);

        try {
            $response = ['bookings' => $bookingGetAll()];
        } catch (Exception $exception) {
            $response = ['bookings' => [], 'error' => $exception->getMessage()];
        }

        return $this->render('bookings/bookings.html.twig', $response);
    }

    private function getFiltersFromRequest(Request $request){
        return [
            'locator'=>$request->get('locator',null),
            'guest'=>$request->get('guest',null),
            'entryDate'=>$request->get('entryDate',null),
            'departureDate'=>$request->get('departureDate',null),
            'hotel'=>$request->get('hotel',null),
            'price'=>$request->get('price',null),
            'possibleActions'=>$request->get('possibleActions',null),
        ];
    }

    public function search(Request $request, SerializerInterface $serializer): Response
    {     
        $bookingSearch = new BookingSearch($this->_bookingRepository);

        $filters = $this->getFiltersFromRequest($request);

        $response  = new JsonResponse();

        try {
            
            $bookings = $bookingSearch($filters);

            $bookingsInArray = $bookings->toPrimitives();

            $response->setData([
                'success' => true,
                'data' => $bookingsInArray,
                'filters'=>$filters
            ]);

        } catch (Exception $exception) {

            $response->setData([
                'success' => false,
                'data' => [],
                'message' => $exception->getMessage()
            ]);
        }
    
        return $response;
    }

    
}
