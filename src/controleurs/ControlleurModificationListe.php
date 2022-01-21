<?php

namespace mywishlist\controleur;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ControlleurModificationListe
{
    public function afficherPageModifListe(Request $requete, Response $reponse, $args) : Response {
        $l = \mywishlist\models\Liste::find( $args['noListe'] ) ;
        $vue = new \mywishlist\vues\VueModificationListe(array($l)) ;
        $html = $vue->render(1) ;
        $reponse->getBody()->write($html);
        return $reponse;
    }

    public function afficherModifFinalisee(Request $requete, Response $reponse) : Response{
        $vue = new \mywishlist\vues\VueModificationListe(array(0));
        $html=$vue->render(2);
        $reponse->getBody()->write($html);
        return $reponse;
    }
}