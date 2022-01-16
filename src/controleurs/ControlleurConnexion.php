<?php

namespace mywishlist\controleur;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControlleurConnexion{

    public function afficherPageConnexion(Request $requete, Response $reponse):Response{

        $vue = new \mywishlist\vues\VueConnexion(array(0)) ;
        $html=$vue->render(1);        
        $reponse->getBody()->write($html);
        return $reponse;
    }

	public function afficherPageInscription(Request $requete, Response $reponse):Response{

        $vue = new \mywishlist\vues\VueConnexion(array(0)) ;
        $html=$vue->render(2);        
        $reponse->getBody()->write($html);
        return $reponse;
    }

    /**
	 * Gestion du formulaire de connexion.
	 * Échappe les balises HTML pour éviter les injections.
	 * Redirige vers le profil si la création de la liste est réussie.
	 */
    public function verifierConnexion(Request $rq, Response $rs, $args): Response {
		// Si le formulaire a été soumis :
        if (isset($_POST['submit'])) {
			// Si le bouton Connexion a été cliqué :
			if ($_POST['submit'] == 'connexion') {
				$email = htmlspecialchars($_POST['email']);
				$pass = $_POST['password'];
				$donnees = Utilisateur::select('*')
					->where('email', '=', $_POST['email'])
					->first();
				// Si l'utilisateur existe :
				if ($donnees!=[]) {
					if (password_verify($pass, $donnees['password'])) {
						echo 'Connexion réussie';
						$_SESSION['email'] = $email;
						$rs = $rs->withRedirect($this->container->router->pathFor('Accueil', ['token'=>$args['token']]));
					}
				} else {
					echo 'Connexion échouée : aucun compte ne correspond à cet email';
				}
			}
        }
		return $rs;
    }
}