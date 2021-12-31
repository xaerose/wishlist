<?php
use mywishlist\models\Item;
use mywishlist\models\Liste;
use Illuminate\Database\Capsule\Manager as DB;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;


require_once 'vendor/autoload.php';
require 'src/controleurs/ControlleurAffichage.php';
require 'src/vues/VueParticipant.php';
require 'src/controleurs/ControlleurConnexion.php';
require 'src/vues/VueConnexion.php';

require 'src/controleurs/ControlleurCreationItem.php';
require 'src/vues/VueCreationItem.php';


$c = [
    'settings' => [
        'displayErrorDetails' => true]
];
$cc = new \Slim\Container($c);
$app = new \Slim\App($cc);
$db = new DB();
$db->addConnection(parse_ini_file('src/conf/db.conf.ini'));

$db->setAsGlobal();
$db->bootEloquent();
//lister liste de souhaits
/**$listes = Liste::get();
foreach ($listes as $liste) {
    echo $liste->titre;
    echo'<br>';
}

echo '<br>';

//lister les items
$items = Item::all();
foreach ($items as $item) {
    echo $item->nom;
    echo'<br>';
}

//afficher un item avec le paramètre en url
$id = $_GET[ 'id' ];
$itemid = Item::where( 'id', '=', $id )->first();
echo $itemid->nom;
$l = $item->liste;
echo $l->titre;


//créer un item et l'insérer dans une liste de souhaits
$i = new Item();
$i->liste_id = 3;
$i->nom = 'Batte';
$i->save();
$i->delete();*/

$app->get('/test/{val}', function ($rq,$rs,$args){
    $c = new \mywishlist\controleur\ControlleurAffichage($this);
    return $c->test($rq,$rs,$args);
})->setName('test');


//Affichage de la liste de la liste de souhait
$app->get('/listes', '\mywishlist\controleur\ControlleurAffichage:afficherListes')->setName('listeDesListes');

$app->get('/connexion', '\mywishlist\controleur\ControlleurConnexion:afficherPageConnexion')->setName('connect');

//l'affichage de la liste des items d'une liste de souhaits
$app->get('/liste/{noListe}', \mywishlist\controleur\ControlleurAffichage::class.':afficherUneListe')->setName('affUneListe');

//l'affichage d'un item désignée par son id
$app->get('/item/{id}', function ($rq, $rs, $args) {
    $c = new \mywishlist\controleur\ControlleurAffichage($this);
    return $c->afficherUnItem($rq, $rs, $args);
})->setName('affUnItem');

//affichage creation d'un item
$app->get('/createItem', '\mywishlist\controleur\ControlleurCreationItem:afficherPageCreationItem')->setName('creerItem');




$app->run();


/**
pour chaque item de la liste
<form action="" method="get" class="form-example">
    <div class="form-example">
        <label for="name">Enter your name: </label>
        <input type="text" name="name" id="name" >
    </div>
    <div class="form-example">
        <input type="submit" value="Subscribe !">
    </div>
</form>
quand c'est souscrie une case apparait en vert avec le nom du participant


<h2>$_GET</h2>
<pre>
    <?php var_dump($_GET);?>
</pre>
*/
