<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Tâches</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
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
        <h1>Liste des Tâches</h1>

        <!-- Affichage des messages de succès -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tab Menu -->
        <div class="tab-menu">
            <button class="tab-link active" onclick="showTab(event, 'all')">Toutes</button>
            <button class="tab-link" onclick="showTab(event, 'En attente')">En attente</button>
            <button class="tab-link" onclick="showTab(event, 'En cours')">En cours</button>
            <button class="tab-link" onclick="showTab(event, 'Terminé')">Terminé</button>
        </div>

        <!-- Table des tâches -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Statut</th>
                        <th>Date limite</th>
                        <th>Catégorie</th>
                        <th>Créée le</th>
                        <th>Mise à jour le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($taches as $tache)
                        <tr class="tache-row {{ str_replace(' ', '-', $tache->statut) }}">
                            <td data-label="ID">{{ $tache->id }}</td>
                            <td data-label="Titre">{{ $tache->titre }}</td>
                            <td data-label="Description">{{ $tache->description }}</td>
                            <td data-label="Statut">
                                <span
                                    class="status status-{{ str_replace(' ', '-', $tache->statut) }}">{{ $tache->statut }}</span>
                            </td>
                            <td data-label="Date limite">{{ $tache->date_limite }}</td>
                            <td data-label="Catégorie">{{ $tache->categorie->nom }}</td>
                            <td data-label="Créée le">{{ $tache->created_at->format('Y-m-d H:i:s') }}</td>
                            <td data-label="Mise à jour le">{{ $tache->updated_at->format('Y-m-d H:i:s') }}</td>
                            <td data-label="Actions">
                                <a href="{{ route('taches.edit', $tache->id) }}" class="btn btn-edit"
                                    aria-label="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>

                                <form action="{{ route('taches.destroy', $tache->id) }}" method="POST"
                                    style="display:inline;" onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" aria-label="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </form>

                                <script>
                                    function confirmDelete() {
                                        return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');
                                    }
                                </script>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">Aucune tâche trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $taches->links() }}
        </div>
    </main>
    <script src="{{asset('js/main.js')}}"></script>
</body>

</html>
