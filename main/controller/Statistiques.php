<?php

final class Statistiques extends Definition\Controller
{
    function statGlobal()
    {
        $adherents = Adherent::getAllAdherents();
        $adherents = Adherent::getGenres($adherents);
        $nbTotal= $adherents['hommes'] + $adherents['femmes'];

        $this->setParameter('adherents', $adherents);
        $this->setParameter('nbTotal', $nbTotal);
    }

    function statClubs()
    {
        $clubs = Club::getClubs();

        $this->setParameter('clubs', $clubs);

        if (!empty($_POST))
        {
            $club = explode("-", $_POST['selectedClub']);
            //$club[0] = id du club
            //$club[1] = nom du club
            
            $adherents = Club::getAdherents( (int) $club[0]);
            $adherents = Adherent::getGenres($adherents);
            //On construit le tableau avec les datas
            $data[] = [
                'nom_club' => $club[1],
                'hommes' => $adherents['hommes'],
                'femmes' => $adherents['femmes']
            ];
            $this->setParameter('data', $data);
        }
    }

    function statAges()
    {
        $adherents = Adherent::getAllAdherents();
        //On récupere l'âge de chaque adhérent
        foreach ($adherents as $adherent) {
            $ages[] = Adherent::getAge($adherent['date_naissance']);
        }
        //On récupére les tranches d'âges
        $tranches = Adherent::getTranchesAges($ages);
        
        $this->setParameter('tranches', $tranches);
    }
}
