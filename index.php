<?php
// PHP_Backend/index.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Autoloader
require_once __DIR__ . '/Autoloader.php';
\App\Autoloader::register();

// Récupération de l'URL
$requestUri = $_SERVER['REQUEST_URI'];
// Nettoyage de l'URL (si on appelle localhost:8000/api/...)
$path = parse_url($requestUri, PHP_URL_PATH);
$path = str_replace('/api/', '', $path);
$path = trim($path, '/');

// Récupération des données JSON envoyées
$inputJSON = file_get_contents('php://input');
$inputData = json_decode($inputJSON, TRUE) ?? [];

// Récupération des données GET (pour les id passés dans l'URL)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $inputData = array_merge($inputData, $_GET);
}

try {
    $controller = null;

    // --- ROUTEUR INTELLIGENT ---
    switch ($path) {
        // JOUEUR
        case 'create_joueur':
            $controller = new \App\Controllers\Joueur\CreateJoueur(
                $inputData['nom_joueur'] ?? '',
                $inputData['prenom_joueur'] ?? '',
                $inputData['numero_licence'] ?? '',
                $inputData['date_naiss'] ?? null,
                $inputData['taille'] ?? null,
                $inputData['poids'] ?? null,
                $inputData['statut_joueur'] ?? 'Actif',
                $inputData['commentaire'] ?? null
            );
            break;
        case 'update_joueur':
            $controller = new \App\Controllers\Joueur\UpdateJoueur(
                $inputData['id_joueur'] ?? null,
                $inputData['nom_joueur'] ?? '',
                $inputData['prenom_joueur'] ?? '',
                $inputData['numero_licence'] ?? '',
                $inputData['date_naiss'] ?? null,
                $inputData['taille'] ?? null,
                $inputData['poids'] ?? null,
                $inputData['statut_joueur'] ?? 'Actif',
                $inputData['commentaire'] ?? null
            );
            break;
        case 'delete_joueur':
            $controller = new \App\Controllers\Joueur\DeleteJoueur($inputData['id'] ?? null);
            break;
        case 'get_joueur_by_id':
            $controller = new \App\Controllers\Joueur\GetJoueurById($inputData['id'] ?? null);
            break;
        case 'read_joueur':
        case 'joueurs':
            $controller = new \App\Controllers\Joueur\ReadJoueur();
            break;

        // MATCH
        case 'create_match':
            $controller = new \App\Controllers\Match\CreateMatch(
                $inputData['date_match'] ?? null,
                $inputData['nom_equipe_adverse'] ?? '',
                $inputData['lieu_de_rencontre'] ?? '',
                $inputData['points_subis'] ?? null,
                $inputData['points_marques'] ?? null,
                $inputData['domiciliation'] ?? '',
                $inputData['sens_match'] ?? ''
            );
            break;
        case 'update_match':
            $controller = new \App\Controllers\Match\UpdateMatch(
                $inputData['id_match'] ?? null,
                $inputData['date_match'] ?? null,
                $inputData['nom_equipe_adverse'] ?? '',
                $inputData['lieu_de_rencontre'] ?? '',
                $inputData['points_subis'] ?? null,
                $inputData['points_marques'] ?? null,
                $inputData['domiciliation'] ?? '',
                $inputData['sens_match'] ?? ''
            );
            break;
        case 'delete_match':
            $controller = new \App\Controllers\Match\DeleteMatch($inputData['id_match'] ?? null);
            break;
        case 'get_match_by_id':
            $controller = new \App\Controllers\Match\GetMatchById($inputData['id_match'] ?? null);
            break;
        case 'read_match':
            $controller = new \App\Controllers\Match\ReadMatch();
            break;

        // PARTICIPER
        case 'create_participer':
            $controller = new \App\Controllers\Participer\CreateParticiper(
                $inputData['id_joueur'] ?? null,
                $inputData['id_match'] ?? null,
                $inputData['poste'] ?? '',
                $inputData['est_titulaire'] ?? 0,
                $inputData['evaluation'] ?? null
            );
            break;
        case 'update_participer':
            $controller = new \App\Controllers\Participer\UpdateParticiper(
                $inputData['id_joueur'] ?? null,
                $inputData['id_match'] ?? null,
                $inputData['poste'] ?? '',
                $inputData['est_titulaire'] ?? 0,
                $inputData['evaluation'] ?? null
            );
            break;
        case 'delete_participer':
            $controller = new \App\Controllers\Participer\DeleteParticiper(
                $inputData['id_joueur'] ?? null,
                $inputData['id_match'] ?? null
            );
            break;
        case 'get_participer_by_ids':
            $controller = new \App\Controllers\Participer\GetParticiperByIds(
                $inputData['id_joueur'] ?? null,
                $inputData['id_match'] ?? null
            );
            break;
        case 'read_participer_by_id_joueur':
            $controller = new \App\Controllers\Participer\ReadParticiperByIdJoueur($inputData['id_joueur'] ?? null);
            break;
        case 'read_participer_by_id_match':
            $controller = new \App\Controllers\Participer\ReadParticiperByIdMatch($inputData['id_match'] ?? null);
            break;

        // COMMENTAIRE
        case 'create_commentaire':
            $controller = new \App\Controllers\Commentaire\CreateCommentaire(
                $inputData['id_joueur'] ?? null,
                $inputData['commentaire'] ?? ''
            );
            break;
        case 'get_commentaires_by_joueur':
            $controller = new \App\Controllers\Commentaire\GetCommentairesByJoueur($inputData['id_joueur'] ?? null);
            break;

        default:
            http_response_code(404);
            echo json_encode(['error' => 'Endpoint non trouvé']);
            exit;
    }

    if ($controller) {
        $result = $controller->execute();
        echo json_encode($result);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
