<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use App\Models\Categorie;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('taches.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'titre.required' => 'Le titre de la tâche est obligatoire.',
            'titre.string' => 'Le titre doit être une chaîne de caractères.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'statut.required' => 'Le statut de la tâche est obligatoire.',
            'statut.in' => 'Le statut doit être l\'un des suivants : En attente, En cours, Terminé.',
            'categorie.required' => 'La catégorie est obligatoire.',
            'categorie.exists' => 'La catégorie sélectionnée n\'existe pas.',
        ];

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut' => 'required|in:En attente,En cours,Terminé',
            'date_limite' => 'nullable|date',
            'categorie' => 'required|exists:categories,id',
        ], $messages);

        Tache::create([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'statut' => $request->input('statut'),
            'date_limite' => $request->input('date_limite'),
            'categorie_id' => $request->input('categorie'),
        ]);

        return redirect()->route('welcome')->with('success', 'La tâche a été créée avec succès.');
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
        $tache = Tache::findOrFail($id);
        $categories = Categorie::all();

        return view('taches.edit', compact('tache', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'titre.required' => 'Le titre de la tâche est obligatoire.',
            'titre.string' => 'Le titre doit être une chaîne de caractères.',
            'titre.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'statut.required' => 'Le statut de la tâche est obligatoire.',
            'statut.in' => 'Le statut doit être l\'un des suivants : En attente, En cours, Terminé.',
            'categorie.required' => 'La catégorie est obligatoire.',
            'categorie.exists' => 'La catégorie sélectionnée n\'existe pas.',
        ];

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut' => 'required|in:En attente,En cours,Terminé',
            'date_limite' => 'nullable|date',
            'categorie' => 'required|exists:categories,id',
        ], $messages);

        $tache = Tache::findOrFail($id);

        $tache->titre = $request->input('titre');
        $tache->description = $request->input('description');
        $tache->statut = $request->input('statut');
        $tache->date_limite = $request->input('date_limite');
        $tache->categorie_id = $request->input('categorie');

        $tache->save();

        return redirect()->route('welcome')->with('success', 'La tâche a été mise à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tache = Tache::findOrFail($id);
        $tache->delete();
        return redirect()->route('welcome')->with('success', 'La tâche a été supprimée avec succès.');
    }

}
