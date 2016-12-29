<?php
/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 21/12/2016
 * Time: 20:40
 */

$loader = new \Phalcon\Loader();

//$loader->registerNamespaces(
//    [
//        'Tusofk\Controllers'=>__DIR__.'/../../controllers/'
//    ]
//)->register();

$loader->registerDirs(

    [
        $config->application->controllersDirs,
        $config->application->modelsDirs,
        $config->application->viewsDir,
        $config->application->libraryDir

    ]
)->register();