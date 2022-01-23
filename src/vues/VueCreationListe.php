<?php

namespace mywishlist\vues;
use \slim\Container;


class VueCreationListe{

    public array $tab;
    public Container $container;

    public function __construct(array $tab, Container $container) {
        $this->tab = $tab;
        $this->container = $container;
    }

    public function creerListePage(){
        return '
        <link rel="stylesheet" href="/style/stylecreationliste.css">
        <div class = "container">
    <div class = "titre">
        <p>Création d\'une WishList </p>
    </div>
    <div class = "contenu">
        <form action="/index.php/createListEnd" method="POST">
            <div id = "texte">
                <input type="text" name="listName" placeholder="Nom de la liste" required/>
            </div>

            <div id = "description">
                <input type="text" name="description" placeholder="Description" required/>
            </div>

            <div id = "dateExpiration" >
                <input type="date" name="expiration" min="2022-01-17"/>
            </div>	

            <button name="submit" type="submit" class="creerListe" value = "boutonCreer">Créer la liste</button>				
        </form>			
    </div>
    </div>';
    }


    public function afficherCreationFin(){
        $content='';
        $content='<br><a href="/index.php/home" class="neon">Retour à l\'accueil</a>';
        $content.=
            '
        <link rel="stylesheet" href="/style/styleListeFinalisee.css">
        <div class = "container">
        <div class = "titre">
            La liste a bien été créée !
        </div>
    </div>';
        return $content;
    }

    public function partagerList(){
        $content='';
        $content.=
		'
        <link rel="stylesheet" href="/style/styleListeFinalisee.css">
        <div class = "container">
        <div class = "titre">
            <h1> Partager </h1>
        </div>

    </div>';
        return $content;
    }
	
    public function render($selecteur) {
        switch ($selecteur) {
            case 1 : {
                $content = $this->creerListePage();
                break;
            }
			case 2 : {
				$content = $this->afficherCreationFin();
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