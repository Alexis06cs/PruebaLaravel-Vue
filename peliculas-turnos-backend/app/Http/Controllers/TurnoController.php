<?php

namespace App\Http\Controllers;
use App\Models\Turno;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function index()
    {
        return Turno::with('pelicula')->get(); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'sala' => 'required|string',
            'estado' => 'required|in:activo,inactivo',
            'pelicula_id' => 'nullable|exists:peliculas,id',
        ]);

        return Turno::create($request->all());
    }


    public function show($id)
    {
        return Turno::with('pelicula')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $turno = Turno::findOrFail($id);
        $turno->update($request->all());
        return response()->json($turno);
    }

    public function destroy($id)
    {
        Turno::destroy($id);
        return response()->json(null, 204);
    }

    public function disponibles() {
        $turnos = Turno::where('estado', 'activo')->whereNull('pelicula_id')->get();
        return response()->json($turnos);
    }

    public function asignarTurno(Request $request, $turnoId) {

    $turno = Turno::findOrFail($turnoId);

    if ($turno->estado !== 'activo') {
        return response()->json(['error' => 'Turno ya asignado'], 400);
    }

    $turno->pelicula_id = $request->pelicula_id;
    $turno->estado = 'inactivo';
    $turno->save();

    return response()->json(['message' => 'Turno asignado correctamente', 'turno' => $turno]);
    }

    public function liberar($turnoId)
    {
        $turno = Turno::findOrFail($turnoId);
        $turno->pelicula_id = null;
        $turno->estado = 'activo';
        $turno->save();

        return response()->json(['message' => 'Turno liberado']);
    }


}