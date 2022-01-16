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
        <div class="contenu">
            <form>
                <div>
                    <label class="neon">Adresse e-mail</label>                    
                    <input type="email" name="email" placeholder="Email">
                    <label class="neon">Mot de passe</label>                    
                    <input type="password" name="password" placeholder="Mot de passe">
                    <input type="submit" name="submit" placeholder="Se connecter" class="neon">                    
                </div>
                
            </form>
            <p>Sinscrire ? <a href="">Inscrivez-vous</a></p>
        </div>
    </div>';
        return $content;
    }

    public function creerCompte(){
        $content='';
        $content.='<div class="container">
        <div class="bg-img"></div>
        <div class="contenu">
            <form>
                <div>
                    <label class="neon">Adresse e-mail</label>                    
                    <input type="email" name="email" placeholder="Email">
                    <label class="neon">Mot de passe</label>                    
                    <input type="password" name="password" placeholder="Mot de passe">
                    <input type="submit" name="submit" placeholder="Se connecter" class="neon">                    
                </div>                
            </form>            
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