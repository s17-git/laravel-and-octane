<?php
namespace App\Interfaces\Http\Controllers\Booking;

use App\Application\Booking\Commands\ReserveTicketCommand;
use App\Application\Booking\Data\TicketData;
use App\Application\Booking\Handlers\ReserveTicketHandler;
use App\Interfaces\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\Booking\StoreReservationRequest;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    public function __construct(private ReserveTicketHandler $handler) {}

    /**
     * Store a new reservation.
     *
     * Expected payload:
     */
    public function store(StoreReservationRequest $request): JsonResponse
    {


        // Request already validated for basic rules by ReservationStoreRequest.
        // Use Spatie Data to validate types / do transformations and get a typed DTO.
        $data = TicketData::validate($request->validated());

        $command = new ReserveTicketCommand(
            (string) $request->input('bus_id'),
            (string) $request->input('user_id'),
            $request->input('seat_number'),
            $request->input('passenger_name'),
            (float)$request->input('price'),
            $request->input('idempotency_key')
        );

        $data = $this->handler->handle($command);

        return response()->json(['data' => $data], 201);
    }
}