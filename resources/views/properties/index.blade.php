@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Liste des Propriétés</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($properties as $property)
                <div class="bg-white p-4 shadow-md rounded-lg">
                    <h3 class="text-lg font-semibold">{{ $property->name }}</h3>
                    <p>{{ $property->description }}</p>
                    <p>Prix: {{ $property->price_per_night }} €/nuit</p>
                    <a href="{{ route('properties.show', $property) }}" class="text-primary hover:underline">Voir plus</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
