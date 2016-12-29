<?php
/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 21/12/2016
 * Time: 20:49
 */

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
//use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;

$di = new FactoryDefault();

$di->setShared('router', function (){
    return require __DIR__ . '/routes.php';
});


//verifier la version de 
$di->setShared('url', function ()use ($config){
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

$di->set( 'db', function ()use ($config){
    return new DbAdapter(
        [
            'host'     => $config->database->host,
            'username' => $config->database->username,
            'password' => $config->database->password,
            'dbname'   => $config->database->dbname
        ]
    );
});

$di->set('modelsMetadata', function () use ($config) {
    return new MetaDataAdapter();
});

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () {
    $session = new SessionAdapter();
    $session->start();
    return $session;
});
$di->set('dispatcher', function () {
    $dispatcher = new Dispatcher();
    //$dispatcher->setDefaultNamespace('Tusofk\Controllers');
    return $dispatcher;
});



/**
 * Setting up the view component
 */
$di->set('view', function() use ($config){
    $view = new View();
    $view->setViewsDir($config->application->viewsDir);
    $view->registerEngines(array(
        ".phtml" => "Phalcon\Mvc\View\Engine\Php"
    ));
    return $view;
});