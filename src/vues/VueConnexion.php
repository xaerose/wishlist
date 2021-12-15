<?php

namespace mywishlist\vue;

class VueConnexion{

    public array $tab;


    public function __construct(array $tab) {
        $this->tab=$tab;
    }

    public function connecter(){
        $content='';
        $content.='<form action="index.php?action=connexion" method="post">
        <input type="text" name="pseudo" placeholder="Pseudonyme" required>
        <input type="password" name="mdp" placeholder="Mot de passe" required>
        <button type="submit"value="Connexion">Se Connecter</button>
        </form>';
        return $content;
    }

    public function creerCompte(){
        $content='';
        return $content;
    }

    public function render($selecteur) {
        switch ($selecteur) {
            case 1 : {
                $content = $this->connecter();
                break;
            }
            case 2 : {
                $content = $this->creerCompte();
                break;
            }
        }
        $html = <<<END
            <!DOCTYPE html>
            <html>
            <body><head>
            <link rel="stylesheet" href="/style/style.css">
            <h1>My Wishlist</h1>
            </head>
                <div class="content">
                    $content
                </div>
            </body>
            </html>
            END ;
        return $html;
    }
}