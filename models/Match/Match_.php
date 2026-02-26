<?php
namespace App\Models\Match;

class Match_ {

    private $id_match;
    private $date_match;
    private $nom_equipe_adverse;
    private $lieu_de_rencontre;
    private $points_subis;
    private $points_marques;
    private $domiciliation;
    private $sens_match;

    public function __construct(
        $date_match,
        $nom_equipe_adverse,
        $lieu_de_rencontre,
        $points_subis,
        $points_marques,
        $domiciliation,
        $sens_match
) {
        $this->date_match = $date_match;
        $this->nom_equipe_adverse = $nom_equipe_adverse;
        $this->lieu_de_rencontre = $lieu_de_rencontre;
        $this->points_subis = $points_subis;
        $this->points_marques = $points_marques;
        $this->domiciliation = $domiciliation;
        $this->sens_match = $sens_match;
    }

    public function toArray()
    {
        return [
            'id_match' => $this->id_match,
            'date_match' => $this->date_match,
            'nom_equipe_adverse' => $this->nom_equipe_adverse,
            'lieu_de_rencontre' => $this->lieu_de_rencontre,
            'points_subis' => $this->points_subis,
            'points_marques' => $this->points_marques,
            'domiciliation' => $this->domiciliation,
            'sens_match' => $this->sens_match
        ];
    }

    public function getId_Match() {
        return $this->id_match;
    }

    public function setId($id_match) {
        $this->id_match = $id_match;
    }

    public function getDate_match() {
        return $this->date_match;
    }

    public function getNom_equipe_adverse() {
        return $this->nom_equipe_adverse;
    }

    public function getLieu_de_rencontre() {
        return $this->lieu_de_rencontre;
    }

    public function getPoints_subis() {
        return $this->points_subis;
    }

    public function getPoints_marques() {
        return $this->points_marques;
    }

    public function getDomiciliation() {
        return $this->domiciliation;
    }

    public function getSens_match() {
        return $this->sens_match;
    }
}
?>