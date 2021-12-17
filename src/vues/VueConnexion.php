<?php

namespace mywishlist\vue;

class VueConnexion{

    public array $tab;


    public function __construct(array $tab) {
        $this->tab=$tab;
    }

    public function connecter(){
        $content='';
        $content.='<div class="container">
        <div class="bg-img"></div>
        <div class="contenu">
            <form>
                <div>
                    <input type="email" name="email" placeholder="Email" required/>
                    <input type="password" name="password" placeholder="Password" required/>
                </div>
                <button class="neon">Se connecter</button>
            </form>
            <p>Sinscrire ? <a href="">Inscrivez-vous</a></p>
        </div>
    </div>';
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
            <link rel="stylesheet" href="/style/styleconnect.css">
            </head>
                    $content
            </body>
            </html>
            END ;
        return $html;
    }
}