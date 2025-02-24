@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Mes Réservations</h1>

        @if($bookings->isEmpty())
            <p>Aucune réservation trouvée.</p>
        @else
            <div class="space-y-4">
                @foreach ($bookings as $booking)
                    <div class="bg-white p-4 shadow-md rounded-lg">
                        <h3 class="font-semibold">{{ $booking->property->name }}</h3>
                        <p>Date de début: {{ $booking->start_date }}</p>
                        <p>Date de fin: {{ $booking->end_date }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
