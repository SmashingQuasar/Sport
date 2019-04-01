<?php

final class Adherents extends Definition\Controller
{
    function listerAdherentsAJour()
    {
        $this->setParameter('adherents', Adherent::getAllAdherents_AJour());
    }

    function listerAdherentsNonAJour()
    {
        $this->setParameter('adherents', Adherent::getAdherentsNonAJour());
    }
}
