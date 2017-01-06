<?php
/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 21/12/2016
 * Time: 09:25
 */
//namespace Tusofk\backend;
use Phalcon\Mvc\Router;



$router = new Router();
$router->removeExtraSlashes(true);

//main route
$router->add("/", array(
    'controller' => 'index',
    'action' => 'index'
));

//add Event
$router->addPost(
    "/event/a/add/{establishment}/{name}/{type}/{date}/{startTime}/{endTime}",
    "Event::add"
);

//add Institution
$router->addPost(
    "/establishment/a/add/{name}/{rating}/{address}/{city}/{district}/{description}",
    "Establishment::add"
);

//Delete event/Institution

$router->addDelete('/:controller/a/:action/:int',
    [
        'controller'=>1,
        'action'=>2,
        'params'=>3
    ]);



//Get Event/Institution info
$router->addGet('/:controller/a/:action/:int',
    [
        'controller'=>1,
        'action'=>2,
        'params'=>3
    ]);

//Get all events/Institutions

$router->addGet('/:controller/a/:action',
    [
        'controller'=>1,
        'action'=>2
    ]);
//
/*
 * add a new user
 */
$router->addPost(
    "/:controller/:action/{nickname:[a-z]+}/{email:[a-z]+}/{phone:[0-9]+}/{password}"
/* [
     "controller"=>1,
     "action"=>2,
     "nickname"=>3,
     "email"=>4,
     "phone"=>5,
     "password"=>6,
 ]*/
);


$router->addGet('/:controller/:action', array(
    'controller'    => 1,
    'action'        => 2,

));
$router->addDelete('/:controller/:action/:id/:nickname', array(

    /*'controller'    => 1,
        'action'        => 2,
        'id' =>3,
        'nickname' => 4*/
));
/*
 * add data in the table message_user_chat
 */

$router->addPost(
    "/:controller/:action/{sender:[0-9]+}/{chat:[0-9]+}/{msg:[0-9]+}/"

);
$router->add(
    "/:controller/:action/{oldnickname:[a-z]+}/{nenwnick:[a-z]+}",
    array(
        'controller' => 1,
         'action'=>2,
        'oldnicrmame'=>3,
        'newnickname' =>4
    )
);
//$router->notFound();
return $router;

