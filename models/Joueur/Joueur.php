<?php

namespace App\Models\Joueur;

class Joueur
{
    private $id_joueur;
    private $nom_joueur;
    private $prenom_joueur;
    private $numero_licence;
    private $date_naiss;
    private $taille;
    private $poids;
    private $statut_joueur;
    private $commentaire;

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

    public function getIdJoueur()
    {
        return $this->id_joueur;
    }
    public function setIdJoueur($id)
    {
        $this->id_joueur = $id;
    }

    public function getNomJoueur()
    {
        return $this->nom_joueur;
    }
    public function setNomJoueur($nom)
    {
        $this->nom_joueur = $nom;
    }

    public function getPrenomJoueur()
    {
        return $this->prenom_joueur;
    }
    public function setPrenomJoueur($prenom)
    {
        $this->prenom_joueur = $prenom;
    }

    public function getNumeroLicence()
    {
        return $this->numero_licence;
    }
    public function setNumeroLicence($licence)
    {
        $this->numero_licence = $licence;
    }

    public function getDateNaiss()
    {
        return $this->date_naiss;
    }
    public function setDateNaiss($date)
    {
        $this->date_naiss = $date;
    }

    public function getTaille()
    {
        return $this->taille;
    }
    public function setTaille($taille)
    {
        $this->taille = $taille;
    }

    public function getPoids()
    {
        return $this->poids;
    }
    public function setPoids($poids)
    {
        $this->poids = $poids;
    }

    public function getStatutJoueur()
    {
        return $this->statut_joueur;
    }
    public function setStatutJoueur($statut)
    {
        $this->statut_joueur = $statut;
    }

    public function getCommentaire()
    {
        return $this->commentaire;
    }
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    public function getNomComplet()
    {
        return $this->prenom_joueur . ' ' . $this->nom_joueur;
    }
}
