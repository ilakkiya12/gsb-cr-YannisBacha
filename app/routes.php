<?php

use Symfony\Component\HttpFoundation\Request;

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
    $typePraticienId = $request->request->get('typePraticien');
    $praticiens = $app['dao.praticien']->findAllByTypePraticien($typePraticienId);
    if(isset($_POST['nom'])) {
    $nomPraticien = $request->request->get('nom');
    $villePraticien = $request->request->get('ville');
    $praticiens = $app['dao.praticien']->findAllByNomVille($nomPraticien,$villePraticien);
    }
    
    return $app['twig']->render('praticiens_resultats.html.twig', array('praticiens' => $praticiens));
})->bind('praticien_resultats');