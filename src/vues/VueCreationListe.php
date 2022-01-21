<?php

namespace mywishlist\vues;

class VueCreationListe{

    public array $tab;

    public function __construct(array $tab) {
        $this->tab=$tab;
    }

    public function creerListePage(){
        $content='';
        $content.=
        '
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

            <button type="submit" class="creerListe">Créer la liste</button>				
        </form>			
    </div>
    </div>';
        return $content;
    }
	

	 public function afficherCreationFin(){
        $content='';
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