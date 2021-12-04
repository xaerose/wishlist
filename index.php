<?php
use mywishlist\models\Item;
use mywishlist\models\Liste;
use Illuminate\Database\Capsule\Manager as DB;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;


require_once 'vendor/autoload.php';

$app = new \Slim\App();
$db = new DB();
$db->addConnection( [
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'wishlist',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
] );
$db->setAsGlobal();
$db->bootEloquent();

//lister liste de souhaits
$listes = Liste::get();
foreach ($listes as $liste) {
    echo $liste->titre;
    echo'<br>';
}

echo '<br>';

//lister les items
$items = Item::all();
//var_dump($items);
foreach ($items as $item) {
    echo $item->nom;
    $titreliste = $item->liste;
    echo'<br>';
}

//afficher un item avec le paramètre en url
$id = $_GET[ 'id' ];
$itemid = Item::where( 'id', '=', $id )->first();
echo $itemid->nom;
$l = $item->liste;
echo $l;


//créer un item et l'insérer dans une liste de souhaits
$i = new Item();
$i->liste_id = 3;
$i->nom = 'Batte';
$i->save();
$i->delete();