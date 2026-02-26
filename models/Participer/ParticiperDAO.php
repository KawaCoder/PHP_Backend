<?php
namespace App\Models\Participer;
use App\Config\Database;
use App\Models\Match\Match;
use PDO;
use PDOException;
use Exception;

class ParticiperDAO {
    private $pdo;

    public static function createParticiper(Participer $participer) {
        try {
            $pdo = Database::getConnection();
            $data = $participer->toArray();
            $requete = "INSERT INTO participer (
                id_joueur, id_match, poste, est_titulaire, evaluation
            ) VALUES (
                :id_joueur, :id_match, :poste, :est_titulaire, :evaluation
            )";

            $query = $pdo->prepare($requete);
            $query->execute([
                ':id_joueur' => $data['id_joueur'],
                ':id_match' => $data['id_match'],
                ':poste' => $data['poste'],
                ':est_titulaire' => $data['est_titulaire'],
                ':evaluation' => $data['evaluation']
            ]);
            return $participer;
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO : Erreur lors de l'insertion d'une participation" . $e->getMessage());
        }
    }

    public static function ReadParticiperByIdMatch($id_match) {
        try {
            $pdo = Database::getConnection();

            $requete = "SELECT * FROM participer WHERE id_match = :id_match";
            $query = $pdo->prepare($requete);
            $query->execute([
                ':id_match' => $id_match
            ]);

            $listeParticipations = $query->fetchAll(PDO::FETCH_ASSOC);
            $participations = [];
            foreach ($listeParticipations as $row) {
                $participation = new Participer(
                    $row['id_joueur'],
                    $row['id_match'],
                    $row['poste'],
                    $row['est_titulaire'],
                    $row['evaluation']
                );
                $participations[] = $participation;
            }
            return $participations;
        } catch(PDOException $e) {
            throw new Exception("Erreur PDO : Erreur lors de la lecture des participations" . $e->getMessage());
        }
    }

    public static function ReadParticiperByIdJoueur($id_joueur) {
        try {
            $pdo = Database::getConnection();

            $requete = "SELECT * FROM participer WHERE id_joueur = :id_joueur";
            $query = $pdo->prepare($requete);
            $query->execute([
                ':id_joueur' => $id_joueur
            ]);

            $listeParticipations = $query->fetchAll(PDO::FETCH_ASSOC);
            $participations = [];
            foreach ($listeParticipations as $row) {
                $participation = new Participer(
                    $row['id_joueur'],
                    $row['id_match'],
                    $row['poste'],
                    $row['est_titulaire'],
                    $row['evaluation']
                );
                $participations[] = $participation;
            }
            return $participations;
        } catch(PDOException $e) {
            throw new Exception("Erreur PDO : Erreur lors de la lecture des participations" . $e->getMessage());
        }
    }

    public static function UpdateParticiper(Participer $participer) {
        try {
            $pdo = Database::getConnection();
            $data = $participer->toArray();
            $requete = "UPDATE participer SET  poste = :poste, est_titulaire = :est_titulaire, evaluation = :evaluation
                        WHERE id_joueur = :id_joueur AND id_match = :id_match";
            $query = $pdo->prepare($requete);
            $query->execute([
                ':id_joueur' => $data['id_joueur'],
                ':id_match' => $data['id_match'],
                ':poste' => $data['poste'],
                ':est_titulaire' => $data['est_titulaire'],
                ':evaluation' => $data['evaluation']
            ]);
            return $participer;
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO : Erreur lors de la modification d'une participation" . $e->getMessage());
        }
    }

    public static function DeleteParticiper($id_joueur, $id_match) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("DELETE FROM participer WHERE id_joueur = :id_joueur AND id_match = :id_match");
            $stmt->execute([
                ':id_joueur' => $id_joueur,
                ':id_match' => $id_match
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO : Erreur lors de la suppression d'une participation" . $e->getMessage());
        }
    }

    public static function getParticiperByIds($id_joueur, $id_match) {
        try {
            $pdo = Database::getConnection();

            $requete = "SELECT * FROM participer WHERE id_joueur = :id_joueur AND id_match = :id_match";
            $query = $pdo->prepare($requete);
            $query->execute([
                ':id_joueur' => $id_joueur,
                ':id_match' => $id_match
            ]);

            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (!$data) {
                return null; // ou lancer une exception si tu veux
            }
            $participant = new Participer(
                $id_joueur,
                $id_match,
                $data['poste'],
                $data['est_titulaire'],
                $data['evaluation']
            );
            return $participant;
        } catch(PDOException $e) {
            throw new Exception("Erreur PDO : Erreur lors de la lecture d'une participation" . $e->getMessage());
        }
    }
}
?>