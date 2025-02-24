<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Properties;
use App\Models\Bookings;
use Illuminate\Support\Facades\Auth;

class BookingManager extends Component
{
    public $property;
    public $start_date;
    public $end_date;
    public $message;

    protected $rules = [
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
    ];

    public function mount(Properties $property)
    {
        $this->property = $property;
    }

    public function book()
    {
        $this->validate();

        Bookings::create([
            'user_id' => Auth::id(),
            'property_id' => $this->property->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $this->message = "Réservation effectuée avec succès !";
    }

    public function render()
    {
        return view('livewire.booking-manager');
    }

}
