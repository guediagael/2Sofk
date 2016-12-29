<?php
/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 20/12/2016
 * Time: 04:38
 */
//use Phalcon\Mvc\Application;
//namespace Tusofk\backend;



error_reporting(E_ALL);
use Phalcon\Mvc\Application;
try {

    $config = include __DIR__ . "/../backend/config/config.php";
   // $config = include 'config.php';

   // include __DIR__ . "/../backend/config.php";

    include __DIR__ . "/../backend/config/loader.php";
    /**
     * Read services
     */
    include __DIR__ . "/../backend/config/services.php";


 //   $response = $application->handle();
   // $response->send();

    $application = new Application($di);
    echo $application->handle()->getContent();
} catch (\Exception $e){
        json_encode($e->getMessage());
}



