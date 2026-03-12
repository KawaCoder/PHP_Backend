<?php
namespace App\Models\Commentaire;

class Commentaire
{
    public $id_commentaire;
    public $date_commentaire;
    public $commentaire;
    public $id_joueur;

    public function __construct(Commentaire $commentaire)
    {
        $this->id_commentaire = $commentaire->getIdCommentaire();
        $this->date_commentaire = $commentaire->getDateCommentaire();
        $this->commentaire = $commentaire->getCommentaire();
        $this->id_joueur = $commentaire->getIdJoueur();
    }
}
