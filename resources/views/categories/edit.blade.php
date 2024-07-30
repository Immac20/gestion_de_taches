<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Catégorie</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('welcome') }}">Accueil</a></li>
                <li><a href="{{ route('categories.index') }}">Catégories</a></li>
                <li><a href="{{ route('taches.create') }}">Nouvelle Tâche</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <h1>Modifier une Catégorie</h1>
        <form class="form-categorie" method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom de la catégorie</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom', $category->nom) }}" >
                @error('nom')
                <div class="error-message">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Mettre à jour la catégorie</button>
                <a href="{{ route('categories.index') }}" class="btn-cancel">Annuler</a>
            </div>
        </form>
    </main>
</body>

</html>
