<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $messages = [
        'nom.required' => 'Le champ nom est obligatoire.',
        'nom.string' => 'Le nom doit être une chaîne de caractères.',
        'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
    ];

    $validated = $request->validate([
        'nom' => 'required|string|max:255',
    ], $messages);

    Categorie::create([
        'nom' => $request->input('nom'),
    ]);

    return redirect()->route('categories.index')->with('success', 'La catégorie a été créée avec succès.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Categorie::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $messages = [
        'nom.required' => 'Le champ nom est obligatoire.',
        'nom.string' => 'Le nom doit être une chaîne de caractères.',
        'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
    ];

    $validated = $request->validate([
        'nom' => 'required|string|max:255',
    ], $messages);

    $category = Categorie::findOrFail($id);

    $category->update([
        'nom' => $validated['nom'],
    ]);

    return redirect()->route('categories.index')->with('success', 'La catégorie a été mise à jour avec succès.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Categorie::findOrFail($id);
    $category->delete();
    return redirect()->route('categories.index')->with('success', 'La catégorie a été supprimée avec succès.');
    }
}
