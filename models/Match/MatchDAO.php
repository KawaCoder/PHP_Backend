<?php
namespace App\Models\Match;
use App\Config\Database;
use App\Models\Match\Match;
use PDO;
use PDOException;
use Exception;

class MatchDAO {
    private $pdo;

    public static function createMatch(Match_ $match) {
        try {
            $pdo = Database::getConnection();
            $data = $match->toArray();
            $requete = "INSERT INTO match_ (
                date_match, nom_equipe_adverse, lieu_de_rencontre, points_subis, 
                point_marques, domiciliation, sens_match
            ) VALUES (
                :date_match, :nom_equipe_adverse, :lieu_de_rencontre, :points_subis, 
                :point_marques, :domiciliation, :sens_match
            )";

            $query = $pdo->prepare($requete);
            $query->execute([
                'date_match' => $data['date_match'],
                'nom_equipe_adverse' => $data['nom_equipe_adverse'],
                'lieu_de_rencontre' => $data['lieu_de_rencontre'],
                'points_subis' => $data['points_subis'],
                'point_marques' => $data['points_marques'],
                'domiciliation' => $data['domiciliation'],
                'sens_match' => $data['sens_match']
            ]);
            return $match;
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO : Erreur lors de l'insertion d'un match" . $e->getMessage());
        }
    }

    public static function ReadMatch() {
        try {
            $pdo = Database::getConnection();

            $requete = "SELECT * FROM match_ ORDER BY date_match";
            $query = $pdo->prepare($requete);
            $query->execute();

            $listeMatchs = $query->fetchAll(PDO::FETCH_ASSOC);
            $matchs = [];
            foreach ($listeMatchs as $row) {
                $match = new Match_(
                    $row['date_match'],
                    $row['nom_equipe_adverse'],
                    $row['lieu_de_rencontre'],
                    $row['points_subis'],
                    $row['point_marques'],
                    $row['domiciliation'],
                    $row['sens_match']
                );
                $match->setId($row['id_match']);
                $matchs[] = $match;
            }
            return $matchs;
        } catch(PDOException $e) {
            throw new Exception("Erreur PDO : Erreur lors de la lecture des matchs" . $e->getMessage());
        }
    }

    public static function UpdateMatch(Match_ $match) {
        try {
            $pdo = Database::getConnection();
            $data = $match->toArray();
            $requete = "UPDATE match_ SET date_match = :date_match, nom_equipe_adverse = :nom_equipe_adverse, 
                    lieu_de_rencontre = :lieu_de_rencontre, points_subis = :points_subis, 
                    point_marques = :point_marques, domiciliation = :domiciliation, sens_match = :sens_match
                    WHERE id_match = :id_match";
            $query = $pdo->prepare($requete);
            $query->execute([
                'id_match' => $data['id_match'],
                'date_match' => $data['date_match'],
                'nom_equipe_adverse' => $data['nom_equipe_adverse'],
                'lieu_de_rencontre' => $data['lieu_de_rencontre'],
                'points_subis' => $data['points_subis'],
                'point_marques' => $data['points_marques'],
                'domiciliation' => $data['domiciliation'],
                'sens_match' => $data['sens_match']
            ]);
            return $match;
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO : Erreur lors de la modification d'un match" . $e->getMessage());
        }
    }

    public static function getMatchById($id) {
        try {
            $pdo = Database::getConnection();

            $sql = "SELECT * FROM match_ WHERE id_match = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $match = new Match_(
                $row['date_match'],
                $row['nom_equipe_adverse'],
                $row['lieu_de_rencontre'],
                $row['points_subis'],
                $row['point_marques'],
                $row['domiciliation'],
                $row['sens_match']
            );
            $match->setId($id);
            return $match;
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO : Erreur lors de la récupération d'un match" . $e->getMessage());
        }
    }

    public static function DeleteMatch($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("DELETE FROM match_ WHERE id_match = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur PDO : Erreur lors de la suppression d'un match" . $e->getMessage());
        }
    }
}
?>