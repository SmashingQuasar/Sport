<?php

final class Meteo extends Definition\Controller
{
    function default()
    {
        $error = null;
        
        if (empty($this->request['request']))
        {
            //Connexion Api avec ApiGeo pour récupérer tous les départements 
            $this->setParameter('departements', ApiGeo::getDepartements());
        }
        if(!empty($this->request['request']['selectedDepartement']))
        {
            $departement = $this->request['request']['selectedDepartement'];
            //Api Geo pour récupérer les communes d'un département
            $this->setParameter('communes', ApiGeo::getCommunes($departement));
        }
        if(!empty($this->request['request']['selectedCommune']))
        {
            //Connexion Api OpenWeather pour récupérer la météo de la commune selectionné par l'utilisateur
            $meteo = new OpenWeather('570906fdd9e00f22e3a55df82c32a992');
            
            $this->setParameter('meteo', $meteo);
            $commune = $this->request['request']['selectedCommune'];
            $this->setParameter('commune', $commune);

            try {
                $this->setParameter('forecast', $meteo->getForecast($commune));
                $this->setParameter('today', $meteo->getToday($commune));
            } catch (Exception $e) {
                $this->setParameter('error', $e->getMessage());
            }

        }
    }
}
