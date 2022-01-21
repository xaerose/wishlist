<?php

namespace mywishlist\controleur;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//include \models\Liste.php;


class ControlleurCreationListe{
    
    protected $listInsertion;


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


    // TODO fix pq la classe trouve pas liste.php
    public function insererList($rq, $rs, $args) {
        // recuperation des variables POST a inserer
    
        //TODO verification de possible injection HTML 
        $listName = $_POST["listName"];
        $description = $_POST["description"];
        $expiration = $_POST["expiration"];
    
        //$listName_verified = $data['name'];
    
        // creation de la nouvelle liste 
        $listInsertion = new Liste();
        // TODO creation d un token 
        $listInsertion->titre = $listName;
        $listInsertion->description = $description;
        $listInsertion->expiration = $expiration;
        $listInsertion->save();
    
        
        // récupère les différentes valeurs et crée une liste 
        $control = new \mywishlist\controleur\ControlleurCreationListe($this);
        
        return $control->afficherCreationFinalisee($rq, $rs, $args);
    }


    public function partagerList(Request $requete, Response $reponse) : Response {
        $vue = new \mywishlist\vues\VueCreationListe(array(0)) ;
        $html = $vue->render(3);
        $reponse->getBody()->write($html);
        return $reponse;
    }
}
