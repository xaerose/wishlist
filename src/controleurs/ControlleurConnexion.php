<?php

namespace mywishlist\controleur;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControlleurConnexion{

    public function afficherPageConnexion(Request $requete, Response $reponse):Response{

        $vue = new \mywishlist\vue\VueConnexion(array(0)) ;
        $html=$vue->render( 1 ) ;
        //$rs->getBody()->write("Liste des listes :");
        $reponse->getBody()->write($html);
        return $reponse;
    }
}