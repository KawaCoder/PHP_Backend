<?php
namespace App\Models\Commentaire;

class Commentaire
{
    private $id_commentaire;
    private $date_commentaire;
    private $commentaire;
    private $id_joueur;

    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getIdCommentaire()
    {
        return $this->id_commentaire;
    }
    public function setIdCommentaire($id)
    {
        $this->id_commentaire = $id;
    }

    public function getDateCommentaire()
    {
        return $this->date_commentaire;
    }
    public function setDateCommentaire($date)
    {
        $this->date_commentaire = $date;
    }

    public function getCommentaire()
    {
        return $this->commentaire;
    }
    public function setCommentaire($text)
    {
        $this->commentaire = $text;
    }

    public function getIdJoueur()
    {
        return $this->id_joueur;
    }
    public function setIdJoueur($id)
    {
        $this->id_joueur = $id;
    }
}
