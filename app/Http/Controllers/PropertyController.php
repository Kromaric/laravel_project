<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Properties;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Properties::all();
        return view('properties.index', compact('properties'));
    }

    // Afficher les détails d'une propriété
    public function show(Properties $property)
    {
        return view('properties.show', compact('property'));
    }
}
