<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('peliculas.index', [
            'peliculas' => Pelicula::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('peliculas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
        ]);

        $pelicula = Pelicula::create($validated);
        session()->flash('exito', 'Pelicula creado correctamente.');
        return redirect()->route('peliculas.index', $pelicula);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelicula $pelicula)
    {
        return view('peliculas.show', [
            'pelicula' => $pelicula,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelicula $pelicula)
    {
        return view('peliculas.edit', [
            'pelicula' => $pelicula,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelicula $pelicula)
    {
        //Ejer4
        foreach ($pelicula->proyecciones as $proyeccion) {
            if($proyeccion->entradas->isNotEmpty()){
                session()->flash('error', 'La pelicula ya tiene entradas vendidas.');
                return redirect()->route('peliculas.index');
            }
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
        ]);

        $pelicula->fill($validated);
        $pelicula->save();
        session()->flash('exito', 'Pelicula modificada correctamente.');
        return redirect()->route('peliculas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelicula $pelicula)
    {
        //Ejer4
        foreach ($pelicula->proyecciones as $proyeccion) {
            if($proyeccion->entradas->isNotEmpty()){
                session()->flash('error', 'La pelicula ya tiene entradas vendidas.');
                return redirect()->route('peliculas.index');
            }
        }

        $pelicula->delete();
        return redirect()->route('peliculas.index');
    }
}
