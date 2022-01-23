<?php

namespace mywishlist\vues;

class VueSupprimerItem{

    public array $tab;

    public function __construct(array $tab) {
        $this->tab=$tab;
    }

    public function supprimerItem(){
        $content='';
        $content.=
        '
        <link rel="stylesheet" href="/style/stylecreationliste.css">
        <div class = "container">
        <div class = "titre">
            Suppression d un item
        </div>
        <div class = "contenu">
            <form action="/index.php/supprimerItemFin" method="POST">
                <div id = "texte">
                    <input type="text" name="idItemSupp" placeholder="ID de l item" required/>
                </div>
				
				
				<button type="submit" class="boutonAjouter">Supprimer cet item</button>				
            </form>			
        </div>
    </div>';
        return $content;
    }

	 public function afficherItemSupprimer(){
        $content='';
        $content.=
		'
    <div class = "container">
        <div class = "titre">
            L item a été supprimé de la base de données.
        </div>
		
		<div class = "contenu">
			<form action="/index.php/home" method="GET">
				<button type="submit" class"boutonAjouter">Revenir à l accueil</button>
			</form>
		</div>

    </div>';
        return $content;
    }

    public function render($selecteur) {
        switch ($selecteur) {
            case 1 : {
                $content = $this->supprimerItem();
                break;
            }
			case 2 : {
				$content = $this->afficherItemSupprimer();
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