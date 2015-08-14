<?php

use Silex\Application;
use Silex\Provider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;

//
// Application setup
//

$app = new Application();
$app['debug'] = true;

$app->register(new Silex\Provider\UrlGeneratorServiceProvider())
    ->register(new Silex\Provider\SessionServiceProvider())
    ->register(new Silex\Provider\ValidatorServiceProvider())
    ->register(new Silex\Provider\DoctrineServiceProvider())
	->register(new Centurion\UserServiceProvider());
	
// Database config. See http://silex.sensiolabs.org/doc/providers/doctrine.html
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'host' => 'localhost',
    'dbname' => 'lmh',
    'user' => 'root',
    'password' => 'root',
);

// Register the Twig templating engine
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/../src/views',
));


/**
 * Load the routes for our REST API handlers as a route collection rather than defining eaach individually 
 * The file /config/routes.yml defines these and this code automatically links the url to to the right PHP code
 */
$app['routes'] = $app->extend('routes', function (RouteCollection $routes, Application $app) {
    $loader     = new YamlFileLoader(new FileLocator(__DIR__ . '/../config'));
    $collection = $loader->load('routes.yml');
    $routes->addCollection($collection);
 
    return $routes;
});


return $app;
