<?php

namespace App\Models\Joueur;

use App\Config\Database;
use PDO;

class JoueurDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function find($id)
    {
        $req = $this->db->prepare('SELECT * FROM joueur WHERE id_joueur = :id');
        $req->execute(['id' => $id]);
        $data = $req->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Joueur($data);
        }
        return null;
    }

    public function findAll()
    {
        $req = $this->db->query('SELECT * FROM joueur');
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $joueurs = [];

        foreach ($results as $data) {
            $joueurs[] = new Joueur($data);
        }
        return $joueurs;
    }

    public function create(Joueur $joueur)
    {
        $sql = 'INSERT INTO joueur (nom_joueur, prenom_joueur, numero_licence, date_naiss, taille, poids, statut_joueur, commentaire) 
                VALUES (:nom, :prenom, :licence, :date_naiss, :taille, :poids, :statut, :commentaire)';

        $req = $this->db->prepare($sql);
        $req->execute([
            'nom' => $joueur->getNomJoueur(),
            'prenom' => $joueur->getPrenomJoueur(),
            'licence' => $joueur->getNumeroLicence(),
            'date_naiss' => $joueur->getDateNaiss(),
            'taille' => $joueur->getTaille(),
            'poids' => $joueur->getPoids(),
            'statut' => $joueur->getStatutJoueur(),
            'commentaire' => $joueur->getCommentaire()
        ]);

        $joueur->setIdJoueur($this->db->lastInsertId());
        return $joueur;
    }

    public function update(Joueur $joueur)
    {
        $sql = 'UPDATE joueur SET 
                nom_joueur = :nom, 
                prenom_joueur = :prenom, 
                numero_licence = :licence, 
                date_naiss = :date_naiss, 
                taille = :taille, 
                poids = :poids, 
                statut_joueur = :statut, 
                commentaire = :commentaire
                WHERE id_joueur = :id';

        $req = $this->db->prepare($sql);
        return $req->execute([
            'nom' => $joueur->getNomJoueur(),
            'prenom' => $joueur->getPrenomJoueur(),
            'licence' => $joueur->getNumeroLicence(),
            'date_naiss' => $joueur->getDateNaiss(),
            'taille' => $joueur->getTaille(),
            'poids' => $joueur->getPoids(),
            'statut' => $joueur->getStatutJoueur(),
            'commentaire' => $joueur->getCommentaire(),
            'id' => $joueur->getIdJoueur()
        ]);
    }

    public function delete($id)
    {
        // 1. Supprimer les commentaires liés
        $reqComm = $this->db->prepare('DELETE FROM commentaire WHERE id_joueur = :id');
        $reqComm->execute(['id' => $id]);

        // 2. Supprimer les participations liées
        $reqPart = $this->db->prepare('DELETE FROM participer WHERE id_joueur = :id');
        $reqPart->execute(['id' => $id]);

        // 3. Supprimer le joueur
        $reqJoueur = $this->db->prepare('DELETE FROM joueur WHERE id_joueur = :id');
        return $reqJoueur->execute(['id' => $id]);
    }
}