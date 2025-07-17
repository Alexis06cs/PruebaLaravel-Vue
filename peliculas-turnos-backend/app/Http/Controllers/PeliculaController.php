<?php

namespace App\Http\Controllers;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    public function index()
    {
        return Pelicula::with('turnos')->get(); 
    }

    public function store(Request $request)
    {
        $pelicula = Pelicula::create($request->all());
        return response()->json($pelicula, 201);
    }

    public function show($id)
    {
        return Pelicula::with('turnos')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->update($request->all());
        return response()->json($pelicula);
    }

    public function destroy($id)
    {
        Pelicula::destroy($id);
        return response()->json(null, 204);
    }
}
