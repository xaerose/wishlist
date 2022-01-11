<?php

namespace mywishlist\controleur;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControlleurCreationItem{

    public function afficherPageCreationItem(Request $requete, Response $reponse):Response{

        $vue = new \mywishlist\vues\VueCreationItem(array(0)) ;
        $html=$vue->render( 1 ) ;
        $reponse->getBody()->write($html);
        return $reponse;
    }
}
