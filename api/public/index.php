<?php 

// Define APP_ROOT and autoloader
define('APP_ROOT',dirname(__DIR__));
require_once APP_ROOT . '/vendor/autoload.php';
require_once APP_ROOT . '/lib/lilypond.php';

// Includes env defined constant (generated through docker image)
@require_once APP_ROOT . '/lib/const.php';

// Creates app
$app = new \Slim\App();


// ------------------------
// INFO ROUTE
// ------------------------
$app->get('/info', function ($request, $response, $args) {

    // gets API Information
    $lp = new LilyPond();
    $result = $lp->info();

	// returns json response
    return $response->withJson($result,200);

});


// ------------------------
// CONVERT ROUTE
// ------------------------
$app->post('/convert', function ($request, $response, $args) {

    // Gets lpData in request
    $lpData = $request->getParsedBody()['lpData'];

    // Convertion
    $lp = new LilyPond();
    $result = $lp->convert($lpData);

	// retrun results	
	return $response->withJson($result,200);

});

// Execution
$app->run();
