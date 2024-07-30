<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Nouvelle Tâche</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{route('welcome')}}">Accueil</a></li>
                <li><a href="{{route('categories.index')}}">Catégories</a></li>
                <li><a href="{{route('taches.create')}}">Nouvelle Tâche</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>Ajouter une Nouvelle Tâche</h1>
        <form class="form-tache" method="POST" action="{{ route('taches.store') }}">
            @csrf
            
            <div class="form-group">
                <label for="titre">Titre de la tâche</label>
                <input type="text" id="titre" name="titre" value="{{ old('titre') }}" >
                @error('titre')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="statut">Statut</label>
                <select id="statut" name="statut" >
                    <option value="En attente" {{ old('statut') == 'En attente' ? 'selected' : '' }}>En attente</option>
                    <option value="En cours" {{ old('statut') == 'En cours' ? 'selected' : '' }}>En cours</option>
                    <option value="Terminé" {{ old('statut') == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                </select>
                @error('statut')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="date_limite">Date limite</label>
                <input type="date" id="date_limite" name="date_limite" value="{{ old('date_limite') }}">
                @error('date_limite')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <select id="categorie" name="categorie" >
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ old('categorie') == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
                @error('categorie')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-submit">Créer la tâche</button>
                <a href="{{ route('taches.index') }}" class="btn-cancel">Annuler</a>
            </div>
        </form>
    </main>
    
</body>
</html>