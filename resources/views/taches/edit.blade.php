<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Tâche</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="categories.html">Catégories</a></li>
                <li><a href="nouvelle-tache.html">Nouvelle Tâche</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>Modifier une Tâche</h1>
        <form class="form-tache" method="POST" action="{{ route('taches.update', $tache->id) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="titre">Titre de la tâche</label>
                <input type="text" id="titre" name="titre" value="{{ old('titre', $tache->titre) }}" required>
                @error('titre')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4">{{ old('description', $tache->description) }}</textarea>
                @error('description')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="statut">Statut</label>
                <select id="statut" name="statut" required>
                    <option value="En attente" {{ old('statut', $tache->statut) == 'En attente' ? 'selected' : '' }}>En attente</option>
                    <option value="En cours" {{ old('statut', $tache->statut) == 'En cours' ? 'selected' : '' }}>En cours</option>
                    <option value="Terminé" {{ old('statut', $tache->statut) == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                </select>
                @error('statut')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="date_limite">Date limite</label>
                <input type="date" id="date_limite" name="date_limite" value="{{ old('date_limite', $tache->date_limite ? $tache->date_limite : '') }}">
                @error('date_limite')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <select id="categorie" name="categorie" required>
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ old('categorie', $tache->categorie_id) == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
                @error('categorie')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-submit">Mettre à jour la tâche</button>
                <a href="{{ route('taches.index') }}" class="btn-cancel">Annuler</a>
            </div>
        </form>
    </main>
</body>
</html>