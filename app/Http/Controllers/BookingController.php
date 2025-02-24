<?php
namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Afficher les réservations de l'utilisateur connecté
    public function index()
    {
        $bookings = Bookings::where('user_id', Auth::id())->get();
        return view('bookings.index', compact('bookings'));
    }

    // Créer une réservation
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        Bookings::create([
            'user_id' => Auth::id(),
            'property_id' => $request->property_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Réservation effectuée avec succès.');
    }

    // Supprimer une réservation
    public function destroy(Bookings $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Réservation supprimée avec succès.');
    }

}
