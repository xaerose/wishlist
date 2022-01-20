<?php

namespace mywishlist\controleur;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControlleurCreationListe{

    public function afficherPageCreationListe(Request $requete, Response $reponse) : Response {
        $vue = new \mywishlist\vues\VueCreationListe(array(0)) ;
        $html = $vue->render(1) ;
        $reponse->getBody()->write($html);
        return $reponse;
    }
	
		public function afficherCreationFinalisee(Request $requete, Response $reponse) : Response{
		$vue = new \mywishlist\vues\VueCreationListe(array(0));
		$html=$vue->render(2);
		$reponse->getBody()->write($html);
        return $reponse;	
	}
        $vue = new \mywishlist\vues\VueCreationListe(array(0)) ;
}
