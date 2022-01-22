<?php
use mywishlist\models\Item;
use mywishlist\models\Liste;
use Illuminate\Database\Capsule\Manager as DB;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;


require_once 'vendor/autoload.php';
require 'src/controleurs/ControlleurAffichage.php';
require 'src/vues/VueParticipant.php';
// le controleur affichage a besoin de la vue accueil pour afficher la landing page
require 'src/vues/VueAccueil.php';

require 'src/controleurs/ControlleurConnexion.php';
require 'src/vues/VueConnexion.php';

require 'src/controleurs/ControlleurCreationItem.php';
require 'src/vues/VueCreationItem.php';

require 'src/controleurs/ControlleurCreationListe.php';
require 'src/vues/VueCreationListe.php';

require 'src/controleurs/ControlleurModificationListe.php';
require 'src/vues/VueModificationListe.php';

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

// Affichage de la landing page 
$app->get('/home', \mywishlist\controleur\ControlleurAffichage::class.':afficherAccueil')->setName('Accueil');

//Affichage de la liste de la liste de souhait
$app->get('/listes', '\mywishlist\controleur\ControlleurAffichage:afficherListes')->setName('listeDesListes');

//Affichage de la page de connexion
$app->get('/connexion','\mywishlist\controleur\ControlleurConnexion:afficherPageConnexion')->setName('connexion');

//affichage de la page d'inscription
$app->get('/inscription','\mywishlist\controleur\ControlleurConnexion:afficherPageInscription')->setName('inscription');

//route verifiant l'inscription
$app->post('/inscription','\mywishlist\controleur\ControlleurConnexion:verifierInscription')->setName('verifierInscription');

//route verifiant la connexion
$app->post('/connexion','\mywishlist\controleur\ControlleurConnexion:verifierConnexion')->setName('verifierConnexion');

//l'affichage de la liste des items d'une liste de souhaits
$app->get('/liste/{token}', \mywishlist\controleur\ControlleurAffichage::class.':afficherUneListe')->setName('affUneListe');

//l'affichage d'un item désignée par son id

$app->get('/item/{id}', function ($rq, $rs, $args) {
    $c = new \mywishlist\controleur\ControlleurAffichage($this);
    return $c->afficherUnItem($rq, $rs, $args);
})->setName('affUnItem');

$app->post('/item/{id}', function ($rq, $rs, $args) {
    $c = new \mywishlist\controleur\ControlleurAffichage($this);
    return $c->afficherUnItem($rq, $rs, $args);
})->setName('affUnItem');

//affichage creation d'un item
$app->get('/createItem', '\mywishlist\controleur\ControlleurCreationItem:afficherPageCreationItem')->setName('creerItem');

$app->map(['GET', 'POST'], '/createItemFin', function ($rq, $rs, $args) {

    $nomInsert = $_POST["nomItem"];
    $descrInsert = $_POST["description"];
	$urlInsert = $_POST["url"];
    $tarifInsert = $_POST["tarif"];

    $itemInsert = new Item();
    $itemInsert->nom = $nomInsert;
    $itemInsert->descr = $descrInsert;
	$itemInsert->url = $urlInsert;
    $itemInsert->tarif = $tarif;
    $itemInsert->save();

    // récupérer les différentes valeurs et crée un item avec
    $control = new \mywishlist\controleur\ControlleurCreationItem($this);
    return $control->afficherFinCreationItem($rq, $rs, $args);


})->setName('afficherFinCreationItem');

/*****************************************************/

//affichage de la page : creation de liste
$app->get('/createList', '\mywishlist\controleur\ControlleurCreationListe:afficherPageCreationListe')->setName('creerListe');


$app->map(['GET', 'POST'], '/createListEnd', function ($rq, $rs, $args) {
    // recuperation des variables POST a inserer

    //TODO verification de possible injection HTML
    $listName = $_POST["listName"];
    $description = $_POST["description"];
    $expiration = $_POST["expiration"];

    // creation de la nouvelle liste
    $listInsertion = new Liste();
    // TODO creation d un token
    $listInsertion->titre = $listName;
    $listInsertion->description = $description;
    $listInsertion->expiration = $expiration;
    $listInsertion->save();

    // récupère les différentes valeurs et crée une liste
    $control = new \mywishlist\controleur\ControlleurCreationListe($this);
    return $control->afficherCreationFinalisee($rq, $rs, $args);


})->setName('afficherCreationListeFinalisee');

/*****************************************************/

/*****************************************************/

//affichage de la page : modification de liste
$app->get('/modifList/{token}', \mywishlist\controleur\ControlleurModificationListe::class.':afficherPageModifListe')->setName('affUneListe');

$app->map(['GET', 'POST'], '/ModifListEnd/{token}', function ($rq, $rs, $args) {
    // recuperation des variables POST a inserer


    $l = Liste::where('token', $args['token'])->first();
    //TODO verification de possible injection HTML
    $listName = $_POST["listName"];
    $description = $_POST["description"];
    $expiration = $_POST["expiration"];

    // modification de la liste
    // TODO creation d un token
    $l->titre = $listName;
    $l->description = $description;
    $l->expiration = $expiration;
    $l->save();

    // récupère les différentes valeurs et crée une liste
    $control = new \mywishlist\controleur\ControlleurModificationListe($this);
    return $control->afficherModifFinalisee($rq, $rs, $args);


})->setName('afficherCreationListeFinalisee');

/*****************************************************/

$app->run();

