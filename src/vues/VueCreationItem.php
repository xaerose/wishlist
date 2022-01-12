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
            <form action="/index.php/createItemFin" method="POST">
                <div id = "texte">
                    <input type="text" name="nomItem" placeholder="Nom de l item" required/>
                </div>
                <div id = "description">
                    <input type="text" name="description" placeholder="Description" required/>
                </div>
                <div>
                    <input type="file" name="illustration" accept="image/png, image/jpeg"/>
                </div>	
				<div id = "texte">
                    <input type="number" name="tarif" placeholder="Tarif" required/>
                </div>
				
				
				<button type="submit" class="boutonAjouter">Ajouter un item</button>				
            </form>			
        </div>
    </div>';
			
        return $content;
    }
	

	 public function afficherItemCreer(){
        $content='';
        $content.=
		'
    <div class = "container">
        <div class = "titre">
            L item a été inséré à la base de données.
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
			case 2 : {
				$content = $this->afficherItemCreer();
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