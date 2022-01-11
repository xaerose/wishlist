<?php

namespace mywishlist\vues;

class VueCreationItem{

    public array $tab;

    public function __construct(array $tab) {
        $this->tab=$tab;
    }

    public function creerItem(){
        $content='';
        $content.=
        '
    <div class = "container">
        <div class = "titre">
            Création d un item
        </div>
        <div class = "contenu">
            <form>
                <div id = "texte">
                    <input type="text" name="id" placeholder="Identifiant de l item" required/>
                    <input type="text" name="nomItem" placeholder="Nom de l item" required/>
                </div>
                <div id = "description">
                    <input type="text" name="description" placeholder="Description" required/>
                </div>
                <div>
                    <input type="file" name="illustration" accept="image/png, image/jpeg" required/>
                </div>
                    
                <button class="boutonAjouter">Ajouter un item</button>
            </form>
        </div>
    </div>';
        return $content;
    }

    public function render($selecteur) {
        switch ($selecteur) {
            case 1 : {
                $content = $this->creerItem();
                break;
            }

        }
        $html = <<<END
            <!DOCTYPE html>
            <html>
            <body><head>
            <link rel="stylesheet" href="/style/stylecreationitem.css">
            </head>
                    $content
            </body>
            </html>
            END ;
        return $html;
    }
}