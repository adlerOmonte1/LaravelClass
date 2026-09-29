<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipanteRequest;
use App\Models\Participante;

class ParticipanteController extends Controller
{
    public function create()
    {
        return view('participantes.create');
    }

    public function store(StoreParticipanteRequest $request)
    {
        Participante::create($request->safe()->except('acepta_terminos'));

        return redirect()->route('participantes.create')->with('success', 'Inscripción registrada correctamente.');
    }
}