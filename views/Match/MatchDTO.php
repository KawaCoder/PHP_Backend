<?php
namespace Views\Match\MatchDTO;

class MatchDTO {

    public $id_match;
    public $date_match;
    public $nom_equipe_adverse;
    public $lieu_de_rencontre;
    public $points_subis;
    public $points_marques;
    public $domiciliation;
    public $sens_match;

    public function __construct(Match_ $match) {
        $this->id_match = $match->getId_Match();
        $this->date_match = $match->getDate_match();
        $this->nom_equipe_adverse = $match->getNom_equipe_adverse();
        $this->lieu_de_rencontre = $match->getLieu_de_rencontre();
        $this->points_subis = $match->getPoints_subis();
        $this->points_marques = $match->getPoints_marques();
        $this->domiciliation = $match->getDomiciliation();
        $this->sens_match = $match->getSens_match();
    }
}
?>