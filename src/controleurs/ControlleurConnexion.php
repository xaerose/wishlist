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
	/**
	 * Controlleur appelant la vue Connexion afin d'afficher le formulaire d'inscription d'un utilisateur
	 */
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


 /**
	 * Gestion du formulaire de connexion.
	 * Échappe les balises HTML pour éviter les injections.
	 * Redirige vers le profil si la création de la liste est réussie.
	 */
    public function verifierInscription(Request $request, Response $rs,): Response {        
			// Si les variables existent et qu'elles ne sont pas vides
			if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']))
			{
				// Patch XSS
				$pseudo = htmlspecialchars($_POST['pseudo']);
				$email =htmlspecialchars($_POST['email']);
				$password = htmlspecialchars($_POST['password']);
				$password_retype = htmlspecialchars($_POST['password_retype']);			
		
				// On vérifie si l'utilisateur existe
				$check = $bdd->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email = ?');
				$check->execute(array($email));
				//$data = $check->fetch();
				$row = $check->rowCount();
		
				$email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..
				
				// Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
				if($row == 0){ 
					if(strlen($pseudo) <= 100){ // On verifie que la longueur du pseudo <= 100
						if(strlen($email) <= 100){ // On verifie que la longueur du mail <= 100
							if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Si l'email est de la bonne forme
								if($password === $password_retype){ // si les deux mdp saisis sont bon
		
									// On hash le mot de passe avec Bcrypt, via un coût de 12
									$cost = ['cost' => 12];
									$password = password_hash($password, PASSWORD_BCRYPT, $cost);							
		
									// On insère dans la base de données
									$insert = $bdd->prepare('INSERT INTO utilisateurs(pseudo, email, password) VALUES(:pseudo, :email, :password)');
									$insert->execute(array(
										'pseudo' => $pseudo,
										'email' => $email,
										'password' => $password,										
									));
									// On redirige avec le message de succès
									header('Location:inscription.php?reg_err=success');
									die();
								}else{$rs= header('Location:index.html'); die();}
							}else{$rs=  header('Location:index.html'); die();}
						}else{ $rs= header('Location:index.html'); die();}
					}else{ $rs= header('Location:index.html'); die();}
				}else{$rs=  header('Location:index.html'); die();}
			}
		return $rs;
	}
	
}

