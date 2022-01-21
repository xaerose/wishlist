<?php

namespace mywishlist\vues;

class VueConnexion{

    public array $tab;

    public function __construct(array $tab) {
        $this->tab=$tab;
    }

    public function connecter(){        
        $content='';
        $content.='<div class="container">
        <div class="bg-img"></div>
        <h1 class="neon">Connexion</h1>
        <div class="contenu">        
            <form methode="POST" action="/index.php/connexion">
                <div>               
                    <label class="neon">Adresse e-mail</label>                    
                    <input type="email" name="email" placeholder="Email">

                    <label class="neon">Mot de passe</label>                    
                    <input type="password" name="password" placeholder="Mot de passe">

                    <input type="submit" name="submit" placeholder="Se connecter" class="neon">                    
                </div>
                
            </form>
            <p>Sinscrire ? <a href="/index.php/inscription">Inscrivez-vous</a></p>
        </div>
    </div>';
        return $content;
    }

    public function creerCompte(){
        $content='';
        $content.='<div class="container">
        <div class="bg-img"></div>
        <h1 class="neon">Inscription</h1>
        <div class="contenu">        
            <form method="POST" action="/index.php/inscription">
                <div>
                    <label class="neon">Nom utilisateur</label>                    
                    <input type="text" name="pseudo" placeholder="Nom utilisateur" autocomplete="off">

                    <label class="neon">Adresse e-mail</label>                    
                    <input type="email" name="email" placeholder="Email" autocomplete="off">

                    <label class="neon">Mot de passe</label>                    
                    <input type="password" name="password" placeholder="Mot de passe" autocomplete="off">

                    <label class="neon"> Confirmation mdp</label>                    
                    <input type="password" name="password_retype" placeholder="Confirmer votre mot de passe" autocomplete="off">
                    
                    <button type="submit" name="submit" class="neon" >Se connecter</button>                    
                </div>                
            </form>
            <!-- <p>Déjà inscrit ? <a href="/index.php/connexion">Connectez-vous</a></p> -->        
        </div>
    </div>';
        return $content;
    }


    public function redirectionInscription(){
        $content='';
        $content.=
            '
        <link rel="stylesheet" href="/style/styleListeFinalisee.css">
        <div class = "container">
        <div class = "titre">
            Vous venez de vous inscrire!
        </div>
    </div>';
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
            case 3 : {
                $content = $this->redirectionInscription();
                break;
            }
        }

        $html = <<<END
            <!DOCTYPE html>
            <html>
            <body><head>
            <link rel="stylesheet" href="/style/styleconnect.css">
            </head>
                    $content
            </body>
            </html>
            END ;
        return $html;
    }
}