<?php 

// Définition APP_ROOT et autoloader
define('APP_ROOT',dirname(__DIR__));
require APP_ROOT . '/vendor/autoload.php';
require APP_ROOT . '/lib/lilypond.php';

// Instanciation de l'application
$app = new \Slim\App();


// ------------------------
// ROUTE INFO
// ------------------------
$app->get('/info', function ($request, $response, $args) {

    // Compose le message retour
	$infos = array(
		'apiName' => 'lilypond',
		'version'=>'1',
		'description' => 'Convertion de fichier lp en midi et pdf',
	);

	// retourne le message
    return $response->withJson($infos,200);

});


// ------------------------
// ROUTE CONVERT
// ------------------------
$app->post('/convert', function ($request, $response, $args) {

    // Recup lpData via la request
    $lpData = $request->getParsedBody()['lpData'];

    // Convertion
    $lp = new LilyPond();
    $result = $lp->convert($lpData);

	// retour resultat	
	return $response->withJson($result,200);

});

// Execution
$app->run();
