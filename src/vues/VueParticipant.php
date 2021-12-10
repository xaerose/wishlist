<?php

namespace mywishlist\vue;

use Illuminate\Contracts\Validation\Validator;

class VueParticipant
{

    public array $tab;


    public function __construct(array $tab) {
        $this->tab=$tab;

    }

    private function htmlListes() : string{
       // echo '<pre>';
       // var_dump($this->tab);
        $content='';
        foreach($this->tab as $l){
            $content .="<article>$l[no] ; $l[user_id]; $l[titre] ; $l[description] ; $l[expiration];$l[token]</article>";
        }  
        return "<section>$content</section>";
    }

    private function htmlUneListe() : string {
       //echo '<pre>';
       //var_dump($this->tab);
        $content='';
        $l = $this->tab[0];
        //var_dump($l);
        $content .="<article>$l[no] ; $l[user_id]; $l[titre] ; $l[description] ; $l[expiration];$l[token]</article>";
        $content.="<ul>";
        $items = $this->tab[1];
        foreach ($items as $item) {
            $url = $_SERVER[ 'DOCUMENT_ROOT' ]."/img/".$item['img'];
            //var_dump($url);
            $content .="<li>$item[id] : <a href=/wishlist/index.php/item/".$item['id'].">$item[nom]</a> ,$item[descr],<img src=".$url.">, $item[tarif] €</li>";
        }
        $content.="</ul>";
        return $content;
    }

    private function htmlUnItem() : string {

        $content='test';
        foreach($this->tab as $l){
            $content .="<article>$l[id];$l[liste_id];$l[descr];$l[nom];$l[tarif]</article>";
        }
        return $content;
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
        $html = <<<END
            <!DOCTYPE html>
            <html>
            <body><head><h1>My Wishlist</h1></head>
                <div class="content">
                    $content
                </div>
            </body>
            </html>
            END ;
        return $html;
    }






}