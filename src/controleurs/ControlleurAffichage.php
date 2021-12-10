<?php

namespace mywishlist\controleur;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControlleurAffichage{
    public function afficherListes(Request $rq, Response $rs, $args):Response{
        //
        $listes = \mywishlist\models\Liste::all();
        $vue = new \mywishlist\vue\VueParticipant( $listes->toArray()) ;
        $html=$vue->render( 1 ) ;
        //$rs->getBody()->write("Liste des listes :");
        $rs->getBody()->write($html);
        return $rs;
    }

    public function afficherUneListe(Request $rq, Response $rs, $args):Response {
        $l = \mywishlist\models\Liste::find( $args['noListe'] ) ;
        $items = $l->items()->get() ;
        $liste[0] = $l->toArray();
        $liste[1] = $items; 
        $vue = new \mywishlist\vue\VueParticipant($liste) ;
        $html=$vue->render( 2 ) ;

        //-----------------//
        //$rs->getBody()->write("Affichage de la liste numéro : ".$args['noListe']);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function afficherUnItem(Request $rq, Response $rs, $args):Response {

        $item = \mywishlist\models\Item::find( $args['id'] ) ;
        $vue = new \mywishlist\vue\VueParticipant( [ $item->toArray() ] ) ;
        $html=$vue->render(3) ;
        //$rs->getBody()->write("Affichage d'un item : ".$args['id']);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function test(Request $rq, Response $rs, $args):Response {
        $rs->getBody()->write("test : ".$args['val']);
        return $rs;
    }
}
