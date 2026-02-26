<?php
namespace App\Models\Commentaire;

use App\Config\Database;
use PDO;

class CommentaireDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findByJoueur($id_joueur)
    {
        $sql = 'SELECT * FROM commentaire WHERE id_joueur = :id ORDER BY date_commentaire DESC, id_commentaire DESC';
        $req = $this->db->prepare($sql);
        $req->execute(['id' => $id_joueur]);
        $results = $req->fetchAll(PDO::FETCH_ASSOC);

        $commentaires = [];
        foreach ($results as $data) {
            $commentaires[] = new Commentaire($data);
        }
        return $commentaires;
    }

    public function create(Commentaire $commentaire)
    {
        $sql = 'INSERT INTO commentaire (date_commentaire, commentaire, id_joueur) VALUES (:date_c, :text, :id_j)';
        $req = $this->db->prepare($sql);
        $req->execute([
            'date_c' => $commentaire->getDateCommentaire(),
            'text' => $commentaire->getCommentaire(),
            'id_j' => $commentaire->getIdJoueur()
        ]);
        $commentaire->setIdCommentaire($this->db->lastInsertId());
        return $commentaire;
    }
}
