<?php

use Symfony\Component\HttpFoundation\Request;
use GSB\domain\Visiteur;
use GSB\Form\Type\VisiteurType;

// Page d'accueil
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
})->bind('home');

// Détails sur un médicament
$app->get('/medicament/{id}', function($id) use ($app) {
    $medicament = $app['dao.medicament']->find($id);
    return $app['twig']->render('medicament.html.twig', array('medicament' => $medicament));
})->bind('medicament');

// Liste de tous les médicaments
$app->get('/medicament/', function() use ($app) {
    $medicaments = $app['dao.medicament']->findAll();
    return $app['twig']->render('medicaments.html.twig', array('medicaments' => $medicaments));
})->bind('medicaments');

// Recherche de médicaments
$app->get('/medicament/recherche/', function() use ($app) {
    $familles = $app['dao.famille']->findAll();
    return $app['twig']->render('medicaments_recherche.html.twig', array('familles' => $familles));
})->bind('medicament_recherche');

// Résultats de la recherche de médicaments
$app->post('/medicament/resultats/', function(Request $request) use ($app) {
    $familleId = $request->request->get('famille');
    $medicaments = $app['dao.medicament']->findAllByFamille($familleId);
    return $app['twig']->render('medicaments_resultats.html.twig', array('medicaments' => $medicaments));
})->bind('medicament_resultats');

// Liste de tous les praticiens
$app->get('/praticien/', function() use ($app) {
    $praticiens = $app['dao.praticien']->findAll();
    return $app['twig']->render('praticiens.html.twig', array('praticiens' => $praticiens));
})->bind('praticiens');

// Détails sur un praticien
$app->get('/praticien/{id}', function($id) use ($app) {
    $praticien = $app['dao.praticien']->find($id);
    return $app['twig']->render('praticien.html.twig', array('praticien' => $praticien));
})->bind('praticien');

// Recherche de praticiens par type
$app->get('/praticien/recherche/', function() use ($app) {
    $types = $app['dao.typePraticien']->findAll();
    return $app['twig']->render('praticiens_recherche.html.twig', array('types' => $types));
})->bind('praticien_recherche');

// Recherche de praticiens par type
$app->get('/praticien/rechercheavancee/', function() use ($app) {
    return $app['twig']->render('praticiens_rechercheavancee.html.twig');
})->bind('praticien_rechercheavancee');

// Résultats de la recherche de praticiens
$app->post('/praticien/resultats/', function(Request $request) use ($app) {
   if($request->request->has('typePraticien')) {
        $typePraticienId = $request->request->get('typePraticien');
        $praticiens = $app['dao.praticien']->findAllByTypePraticien($typePraticienId);
    }
    else {
        $nomPraticien = $request->request->get('nom');
        $villePraticien = $request->request->get('ville');
        $praticiens = $app['dao.praticien']->findAllByNomVille($nomPraticien,$villePraticien);
           }
    return $app['twig']->render('praticiens_resultats.html.twig', array('praticiens' => $praticiens));
})->bind('praticien_resultats');




// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');

/* // Détails sur un praticien
$app->get('/profil', function() use ($app) {
    return $app['twig']->render('profil.html.twig');
})->bind('profil');
*/


// Profil utilisateur
$app->match('/profil', function(Request $request) use ($app) {
    $visiteur = $app['user'];
    $visiteurFormView = null;
    $visiteurForm = $app['form.factory']->create(new VisiteurType(), $visiteur);
    $visiteurForm->handleRequest($request);
    if ($visiteurForm->isSubmitted() && $visiteurForm->isValid()) {
        $plainPassword = $visiteur->getPassword();
        // find the encoder for a UserInterface instance
        $encoder = $app['security.encoder_factory']->getEncoder($visiteur);
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $visiteur->getSalt());
        $visiteur->setPassword($password); 
        $app['dao.visiteur']->save($visiteur);
        $app['session']->getFlashBag()->add('success', 'Vos informations personnelles ont été mises à jour.');
    }
    $visiteurFormView = $visiteurForm->createView();
    return $app['twig']->render('profil.html.twig', array('visiteurForm' => $visiteurFormView));
})->bind('profil');



// Liste de tous les rapports de visite
$app->get('/rapport/', function() use ($app) {
    $rapports = $app['dao.rapport']->findAllByVisiteur($app['user']->getId());
    return $app['twig']->render('rapports.html.twig', array('rapports' => $rapports));
})->bind('rapports');


