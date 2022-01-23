<?php

namespace mywishlist\controleur;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControlleurSuppresionItem{

    public function afficherPageSuppresionItem(Request $requete, Response $reponse):Response{
        $vue = new \mywishlist\vues\VueSupprimerItem(array(0)) ;
        $html=$vue->render( 1 ) ;
        $reponse->getBody()->write($html);
        return $reponse;
    }
	
	
		public function afficherFinSuppressionItem(Request $requete, Response $reponse):Response{
		$vue = new \mywishlist\vues\VueSupprimerItem(array(0));
		$html=$vue->render(2);
		$reponse->getBody()->write($html);
        return $reponse;	
	}
	
	
	
}
