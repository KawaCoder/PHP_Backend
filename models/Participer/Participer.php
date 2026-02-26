<?php
namespace App\Models\Participer;

class Participer {
    private $id_joueur;
    private $id_match;
    private $poste;
    private $est_titulaire;
    private $evaluation;

    public function __construct($id_joueur, $id_match, $poste, $est_titulaire, $evaluation) {
        $this->id_joueur = $id_joueur;
        $this->id_match = $id_match;
        $this->poste = $poste;
        $this->est_titulaire = $est_titulaire;
        $this->evaluation = $evaluation;
    }

    public function toArray() {
        return [
            'id_joueur' => $this->id_joueur,
            'id_match' => $this->id_match,
            'poste' => $this->poste,
            'est_titulaire' => $this->est_titulaire,
            'evaluation' => $this->evaluation
        ];
    }

    public function getId_Joueur() {
        return $this->id_joueur;
    }

    public function getId_Match() {
        return $this->id_match;
    }

    public function getPoste() {
        return $this->poste;
    }

    public function getEst_Titulaire() {
        return $this->est_titulaire;
    }

    public function getEvaluation() {
        return $this->evaluation;
    }
}
?>