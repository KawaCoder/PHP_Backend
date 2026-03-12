<?php
namespace Views\Joueur\JoueurDTO;

class JoueurDTO
{
    public $id_joueur;
    public $nom_joueur;
    public $prenom_joueur;
    public $numero_licence;
    public $date_naiss;
    public $taille;
    public $poids;
    public $statut_joueur;
    public $commentaire;

    public function __construct(Joueur $joueur) {
        $this->id_joueur = $joueur->getIdJoueur();
        $this->nom_joueur = $joueur->getNomJoueur();
        $this->prenom_joueur = $joueur->getPrenomJoueur();
        $this->numero_licence = $joueur->getNumeroLicence();
        $this->date_naiss = $joueur->getDateNaiss();
        $this->taille = $joueur->getTaille();
        $this->poids = $joueur->getPoids();
        $this->statut_joueur = $joueur->getStatutJoueur();
        $this->commentaire = $joueur->getCommentaire();
    }
}