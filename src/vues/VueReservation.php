<?php

namespace mywishlist\vue;

class VueReservation{

    public array $tab;


    public function __construct(array $tab) {
        $this->tab=$tab;
    }

    public function reservation():string{
        $content='';
        $content.='<div class="container">
        <div class="bg-img"></div>
        <div class="contenu">
            <form>
                <div>
                    <input type="text" name="nom" placeholder="Nom" />
                </div>
                <button class="neon">Reserver</button>
            </form>
        </div>
    </div>';
        return $content;
    }

    public function render($selecteur) {
        switch ($selecteur) {
            case 1 : {
                $content = $this->reservation();
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