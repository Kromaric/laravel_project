@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold">{{ $property->name }}</h1>
        <p>{{ $property->description }}</p>
        <p>Prix : {{ $property->price_per_night }} €/nuit</p>

        @livewire('booking-manager', ['property' => $property])
    </div>
@endsection
