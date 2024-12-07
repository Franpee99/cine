<?php

namespace App\Http\Controllers;

use App\Models\Proyeccion;
use Illuminate\Http\Request;

class ProyeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('proyecciones.index', [
            'proyecciones' => Proyeccion::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proyecciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelicula_id' => 'required|exists:peliculas,id',
            'sala_id' => 'required|exists:salas,id',
            'fecha_hora' => [
                                'required',
                                'date_format:Y-m-d H:i:s',
                                'after_or_equal:2024-12-07 00:00:00', // Mínima
                                'before_or_equal:2024-12-31 23:59:59', // Máxima
                            ],
        ]);

        $proyeccion = Proyeccion::create($validated);
        session()->flash('exito', 'Proyeccion creado correctamente.');
        return redirect()->route('proyecciones.index', $proyeccion);
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyeccion $proyeccion)
    {

        return view('proyecciones.show', [
            'proyeccion' => $proyeccion,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyeccion $proyeccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyeccion $proyeccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyeccion $proyeccion)
    {
        $proyeccion->delete();
        return redirect()->route('proyecciones.index');
    }
}
