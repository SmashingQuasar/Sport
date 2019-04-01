<?php

final class Clubs extends Definition\Controller
{
    function listerClubAdherents()
    {
        $clubs = Club::getClubs();
        
        $this->setParameter('clubs', $clubs);
        
        if (!empty($this->request['request'])) {
            $idClub = $this->request['request']['selectedClub'];
            $adherentsClub = Club::getAdherents((int) $idClub);
            $this->setParameter('adherents', $adherentsClub);
        }
    }

    function ajouterAdherent()
    {
        $clubs = Club::getClubs();

        $this->setParameter('clubs', $clubs);
        
        if (!empty($this->request['request'])) {
            $prenom = htmlentities($this->request['request']['prenom']);
            $nom = htmlentities($this->request['request']['nom']);
            $date = htmlentities($this->request['request']['date']);
            $genre = htmlentities($this->request['request']['genre']);
            $idClub = explode('-', $this->request['request']['club']);
            $licence = htmlentities($this->request['request']['licence']);
            
            //On ajoute l'adhérent dans la bdd
            $ok = Club::AjouterAdherent($prenom, $nom, $date, $genre);
            
            $this->setParameter('success', false);

            // $sucess = false;
            //Si l'adhérent a bien été ajouté, on crée son inscription

            if ($ok) {
                $idAdherent = Cnx::getLastInsertId();
                $ok = AdherentsEstInscrit::AjouterInscription($idAdherent, $idClub[0], date('Y-m-d'), $licence);

                $this->setParameter('success', true);
                // $sucess = true ;
            }
        }
    }
}
