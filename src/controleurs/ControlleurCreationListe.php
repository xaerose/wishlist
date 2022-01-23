<?php

namespace mywishlist\controleur;

use mywishlist\models\Liste;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//include \models\Liste.php;
use \slim\Container;

use \mywishlist\vues\VueCreationListe;


class ControlleurCreationListe{
    
    private Container $container;

    public function __construct($contain)
    {
        $this->container = $contain;
    }

    public function afficherPageCreationListe(Request $requete, Response $reponse): Response
    {
        $vue = new VueCreationListe([], $this->container);

        $html = $vue->render(1);
        $reponse->getBody()->write($html);

        return $reponse;
    }

    public function afficherCreationFinalisee(Request $requete, Response $reponse): Response
    {
        $vue = new \mywishlist\vues\VueCreationListe([], $this->container);

        $listInsertion = new Liste();

        $listName = $_POST['listName'];
        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $expiration = $_POST['expiration'];

        $listInsertion->titre = $listName;
        $listInsertion->description = $description;
        $listInsertion->expiration = $expiration;
        $listInsertion->save();
        //$listInsertion = Liste::where('listName',$_POST['listName'])->first();


        $html = $vue->render(2);
        $reponse->getBody()->write($html);
        return $reponse;
    }


    public function partagerList(Request $requete, Response $reponse) : Response {
        $vue = new \mywishlist\vues\VueCreationListe(array(0)) ;
        $html = $vue->render(3);
        $reponse->getBody()->write($html);
        return $reponse;
    }
}
