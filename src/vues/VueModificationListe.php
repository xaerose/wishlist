<?php

namespace mywishlist\vues;

class VueModificationListe
{
    public array $tab;

    public function __construct(array $tab) {
        $this->tab=$tab;
        //echo $tab;
    }

    
    public function modifListePage(){
        $content='';
        //  $content = $this->tab[0]->token;
        $content.=
            '
        <link rel="stylesheet" href="/style/stylecreationliste.css">
        <div class = "container">
    <div class = "titre">
        <p>Modification d\'une WishList </p>
    </div>
    <div class = "contenu">
        <form action="/index.php/ModifListEnd/'.$this->tab[0]->token.'" method="POST">
            <div id = "texte">
                <input type="text" name="listName" placeholder="Nom de la liste" value="'.$this->tab[0]->titre.'" required/>
            </div>

            <div id = "description">
                <input type="text" name="description" placeholder="Description" value="'.$this->tab[0]->description.'" required/>
            </div>

            <div id = "dateExpiration" >
                <input type="date" name="expiration" value="'.$this->tab[0]->expiration.'" min="2021-01-17"/>
            </div>	

            <button type="submit" class="creerListe">Modifier la liste</button>				
        </form>			
    </div>
    </div>';
        return $content;
    }


    public function afficherModificationFin(){
        $content='';
        $content.=
            '
        <link rel="stylesheet" href="/style/styleListeFinalisee.css">
        <div class = "container">
        <div class = "titre">
            La liste a bien été modifié !
        </div>
    </div>';
        return $content;
    }

    public function render($selecteur) {
        switch ($selecteur) {
            case 1 : {
                $content = $this->modifListePage();
                break;
            }
            case 2 : {
                $content = $this->afficherModificationFin();
                break;
            }
        }
        $html = <<<END
            <!DOCTYPE html>
            <html>
            <body>
            <head> </head>
                $content
            </body>
            </html>
            END ;
        return $html;
    }
}