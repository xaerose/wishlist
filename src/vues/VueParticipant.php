<?php

namespace mywishlist\vues;

use Illuminate\Contracts\Validation\Validator;

class VueParticipant
{

    public array $tab;


    public function __construct(array $tab) {
        $this->tab=$tab;

    }

    private function htmlListes() : string{
        $content='';
        foreach($this->tab as $l){
            $content .="<article>$l[no]: $l[user_id],<a href=/index.php/liste/$l[no]>$l[titre]</a>, $l[description], $l[expiration], $l[token]</article>
                ";

        }  
        return "<section>$content</section>";
    }

    private function htmlUneListe() : string {
        $content='';
        $l = $this->tab[0];
        $content .="<article>$l[no]: $l[user_id], $l[titre], $l[description], $l[expiration], $l[token]</article>";
        $content.="<ul>";
        $items = $this->tab[1];
        foreach ($items as $item) {
            $url = "/img/".$item['img'];
            $content .="<li>$item[id]: <a href=/index.php/item/".$item['id'].">$item[nom]</a> ,$item[descr], $item[tarif] €, <br> <img src=".$url."></li>";
        }
        $content.="</ul>";
        $content.="<br><p>Insérer un message</p>";
        $content.='<form method="POST">
        <div id = "message">
                <input type="text" name="Message" placeholder="Message" required/>
        </div>
        <button type="submit" class="creerMessage">Envoyer le message</button>
        </form>';
        return $content;
    }

    private function htmlUnItem() : string {
        $nom = null;
        $nom2 = htmlentities($nom);
        $affichage='';
        foreach($this->tab as $item){
        if($nom){
            $affichage = '
                            <h2> //ce qui est insert dans la bdd  </h2>
                         ';
        } else {
            $affichage = '
                            <form action="#" method="post">
                                <div class="form">
                                       <input class="form-control" name="nom" placeholder="Réserver un item">                  
                                    </div>
                                    <button class="btn btn-primary">Réserver</button>
                                </form>
                            ';
            }
                $url = "/img/".$item['img'];
                $affichage .="<article>$item[id]: $item[descr], $item[tarif] €, <br> <img src=".$url."></article>";
            }

        return $affichage;

    }

    public function render($selecteur) {
        switch ($selecteur) {
            case 1 : {
                $content = $this->htmlListes();
                break;
            }
            case 2 : {
                $content = $this->htmlUneListe();
                break;
            }
            case 3 : {
                $content = $this->htmlUnItem();
                break;
            }
        }
        $listNo=$this->tab[0]['no'];
        $html = <<<END
            <!DOCTYPE html>
            <html>
            <body><head>
            <link rel="stylesheet" href="/style/style.css">
            <h1>My Wishlist</h1>
            <a href="/index.php/modifList/$listNo" class="btn btn-primary">Modifier</a>
            </head>
                <div class="content">
                    $content
                </div>
            </body>
            </html>
            END ;
        return $html;
    }






}