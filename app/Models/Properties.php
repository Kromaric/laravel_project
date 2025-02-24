<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class Properties extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price_per_night', 'location', 'image', 'capacity',];

    public function bookings(): HasMany
    {
        return $this->hasMany(Bookings::class);
    }

    // Stocke l'image dans le dossier public/properties
    public function setImageAttribute($value)
    {
        if ($value instanceof UploadedFile) {
            $this->attributes['image'] = $value->store('properties', 'public');
        }
    }

    // Récupère l'URL de l'image
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }
}
