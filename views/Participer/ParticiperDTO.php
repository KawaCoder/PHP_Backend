<?php
namespace App\Models\Participer;

class Participer {

    public $id_joueur;
    public $id_match;
    public $poste;
    public $est_titulaire;
    public $evaluation;

    public function __construct(Participer $participer) {
        $this->id_joueur = $participer->getId_Joueur();
        $this->id_match = $participer->getId_Match();
        $this->poste = $participer->getPoste();
        $this->est_titulaire = $participer->getEst_Titulaire();
        $this->evaluation = $participer->getEvaluation();
    }
}
?>