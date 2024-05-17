<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Espace;
use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with('payment')->where('user_id', auth('api')->user()->id)->get();

        if ($reservations->isEmpty()) {
            return response()->json([
                'message' => 'No Reservation found.',
            ], 404);
        }
        return response()->json(array('reservations' => $reservations));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        try {
            $espace = Espace::find($request->espace_id);

            if ($espace->isAvailable($request->checkIn, $request->checkOut)) {

                $sessionData = [
                    'user_id' => auth('api')->user()->id,
                    'espace_id' => $request->espace_id,
                    'check_in_date' => $request->check_in_date,
                    'check_out_date' => $request->check_out_date,
                    'total_price' => $request->total_price,
                ];

                return app(PaymentController::class)->checkout($sessionData);
            } else {
                return response()->json(['error' => 'Espace is not available'], 400);
            }
        } catch (AuthorizationException $e) {
            return response()->json(['error' => 'Something went wrong please try again.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Reservation $reservation)
    {
        $espace = $reservation->espace;

        if (!$espace) {
            return response()->json(['message' => 'Reservation not found.'], 404);
        }

        $espaces = Espace::with('category', 'services', 'equipements')->latest()->paginate(6);
        $images = $espace->load('category', 'services', 'equipements')->getMedia('espaces');

        return response()->json([
            'espaces' => $espaces,
            'espace' => $espace,
            'images' => $images,
            'reservation' => $reservation
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Reservation $reservation)
    {

            // $this->authorize('update', $reservation);

        $espace = $reservation->espace;

        if (!$espace) {
            return response()->json(['message' => 'Reservation not found.'], 404);
        }

        $espaces = Espace::with('category', 'services', 'equipements')->latest()->paginate(6);
        $images = $espace->load('category', 'services', 'equipements')->getMedia('espaces');

        return response()->json([
            'espaces' => $espaces,
            'espace' => $espace,
            'images' => $images,
            'reservation' => $reservation
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        try {
            $reservation->delete();

            return response()->json([
                'message' => 'Reservation deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }
}
