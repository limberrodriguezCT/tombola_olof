<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Http\Requests\StoreParticipantRequest;

class ParticipantController extends Controller
{
    public function create()
    {
        return view('welcome');
    }

    public function store(StoreParticipantRequest $request)
    {
        Participant::create($request->validated());

        return redirect()->route('welcome')->with('success', '¡Registro completado con éxito! Gracias por participar.');
    }

    public function index()
    {
        $participants = Participant::latest()->get();
        return view('dashboard', compact('participants'));
    }

    public function tombola()
    {
        return view('tombola');
    }

    public function getWinner()
    {
        $winner = Participant::inRandomOrder()->first();
        
        if (!$winner) {
            return response()->json(['error' => 'No hay participantes registrados.'], 404);
        }

        return response()->json($winner);
    }
}