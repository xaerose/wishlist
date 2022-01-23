<?php

namespace mywishlist\controleur;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use \mywishlist\vues\VueReservation as VueReservation;

use \mywishlist\vues\VueAccueil as VueAccueil;
use \mywishlist\models\Liste as liste;
use \mywishlist\models\Item as item;

class ControlleurAffichage
{


    public function afficherAccueil(Request $rq, Response $rs, $args): Response
    {
        $listes = \mywishlist\models\Liste::all();
        $vue = new \mywishlist\vues\VueAccueil($listes->toArray());
        $html = $vue->render();
        $rs->getBody()->write($html);
        return $rs;
    }

    public function afficherListes(Request $rq, Response $rs, $args): Response
    {
        //
        $listes = \mywishlist\models\Liste::all();
        $vue = new \mywishlist\vues\VueParticipant($listes->toArray());
        $html = $vue->render(1);
        //$rs->getBody()->write("Liste des listes :");
        $rs->getBody()->write($html);
        return $rs;
    }

    public function afficherUneListe(Request $rq, Response $rs, $args): Response
    {
        $l = \mywishlist\models\Liste::find($args['token']);
        $items = $l->items()->get();
        $liste[0] = $l->toArray();
        $liste[1] = $items;
        $vue = new \mywishlist\vues\VueParticipant($liste);
        $html = $vue->render(2);

        //-----------------//
        //$rs->getBody()->write("Affichage de la liste numéro : ".$args['noListe']);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function afficherUnItem(Request $rq, Response $rs, $args): Response
    {

        $item = \mywishlist\models\Item::find($args['id']);
        $vue = new \mywishlist\vues\VueParticipant([$item->toArray()]);
        $html = $vue->render(3);
        //$rs->getBody()->write("Affichage d'un item : ".$args['id']);
        $rs->getBody()->write($html);
        return $rs;
    }

    public function test(Request $rq, Response $rs, $args): Response
    {
        $rs->getBody()->write("test : " . $args['val']);
        return $rs;
    }

    public function reserverUnItem(Request $requete, Response $reponse): Response
    {
        $vue = new VueReservation(array(0));
        $html = $vue->render(1);
        //$rs->getBody()->write("Liste des listes :");
        $reponse->getBody()->write($html);
        return $reponse;
    }

    public function verifierReservation(Request $request, Response $response, $args)
    {
        if (empty($_SESSION['user'])|| $_SESSION['user']==-1) {
            print_r("salut");
            return $response->withRedirect('/index.php/connexion?res=Vous devez vous connecter');

        }

        $item = Item::where('id', '=', $args['id'])->first();
        $list = Liste::where('no', '=', $item['liste_id'])->first();

        $item->reservations = $_SESSION['user'];

        $item->save();
        $args['id'] = $item->id;

        return $response->withRedirect('/index.php/item/' . $item['id'] . '?res=reservation%20Effectué');

    }


}
