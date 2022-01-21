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

    public function afficherPageInscriptionRedirection(Request $requete, Response $reponse):Response{

        $vue = new \mywishlist\vues\VueConnexion(array(0)) ;
        $html=$vue->render(3);
        $reponse->getBody()->write($html);
        return $reponse;
    }

    /**
	 * Gestion du formulaire de connexion.
	 * Échappe les balises HTML pour éviter les injections.
	 * Redirige vers le profil si la création de la liste est réussie.
	 */
    public function verifierConnexion(Request $rq, Response $rs, $args): Response {
        session_start(); // Démarrage de la session
        if(!empty($_POST['email']) && !empty($_POST['password'])) // Si il existe les champs email, password et qu'il sont pas vident
        {
            // Patch XSS
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $email = strtolower($email); // email transformé en minuscule

            // On regarde si l'utilisateur est inscrit dans la table utilisateurs
            $check = $bdd->prepare('SELECT pseudo, email, password, token FROM utilisateurs WHERE email = ?');
            $check->execute(array($email));
            $data = $check->fetch();
            $row = $check->rowCount();

            // Si > à 0 alors l'utilisateur existe
            if($row > 0)
            {
                // Si le mail est bon niveau format
                if(filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    // Si le mot de passe est le bon
                    if(password_verify($password, $data['password']))
                    {
                        // On créer la session et on redirige sur landing.php
                        $_SESSION['user'] = $data['token'];
                        header('Location: landing.php');
                        die();
                    }else{ header('Location:index.html'); die(); }
                }else{ header('Location:index.html'); die(); }
            }else{ header('Location:index.html'); die(); }
        }else{ header('Location:index.html'); die();} // si le formulaire est envoyé sans aucune données
    }

 /**
	 * Gestion du formulaire de connexion.
	 * Échappe les balises HTML pour éviter les injections.
	 * Redirige vers le profil si la création de la liste est réussie.
	 */
    public function verifierInscription(Request $request, Response $rs): Response {
        // Si les variables existent et qu'elles ne sont pas vides
        if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']))
        {
            // Patch XSS
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $password_retype = htmlspecialchars($_POST['password_retype']);

            // On vérifie si l'utilisateur existe
            $check = $bdd->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email = ?');
            $check->execute(array($email));
            $data = $check->fetch();
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

                                // On stock l'adresse IP
                                $ip = $_SERVER['REMOTE_ADDR'];

                                // On insère dans la base de données
                                $insert = $bdd->prepare('INSERT INTO utilisateurs(pseudo, email, password, ip, token) VALUES(:pseudo, :email, :password, :ip, :token)');
                                $insert->execute(array(
                                    'pseudo' => $pseudo,
                                    'email' => $email,
                                    'password' => $password,
                                    'ip' => $ip,
                                    'token' => bin2hex(openssl_random_pseudo_bytes(64))
                                ));
                                // On redirige avec le message de succès
                                $rs=header('Location:index.html');
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

