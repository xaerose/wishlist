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
        $content='';
        foreach($this->tab as $l){
            $content .="<article>$l[no]: $l[user_id],<a href=/index.php/liste/$l[no]>$l[titre]</a>, $l[description], $l[expiration], $l[token]</article>";
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
        return $content;
    }

    private function htmlUnItem() : string {

        $content='';

        foreach($this->tab as $item){
            $url = "/img/".$item['img'];
            $content .="<article>$item[id]: $item[descr], $item[tarif] €, <br> <img src=".$url."></article>";
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
            <body><head>
            <link rel="stylesheet" href="/style/style.css">
            <h1>My Wishlist</h1>
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