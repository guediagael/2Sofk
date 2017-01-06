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

//add establishment
$router->addPost(
    "/establishment/a/add/{name}/{rating}/{city}/{district}/{description}/{longitude}/{latitude}",
    "Establishment::add"
);

//add Event
$router->addPost(
    "/event/a/add/{establishment}/{name}/{type}/{date}/{startTime}/{endTime}/{description}",
    "Event::add"
);


//add Branch
$router->addPost(
    "/branch/a/add/{establishment_id}/{city}/{district}/{description}/{longitude}/{latitude}/{rating}",
    "Branch::add"
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

//Edit event
$router->addPut(
    "/event/a/update/{id}/{establishment}/{name}/{type}/{date}/{startTime}/{endTime}/{description}",
    "Event::update");

//Edit establishment
$router->addPut(
    "/establishment/a/update/{id}/{name}/{rating}/{address}/{city}/{district}/{description}",
    "Establishment::update"
);

$router->AddGet(
    "/branch/a/find/{establishment_id}/{city}/{district}",
    "Branch::find"
);
//
////edit event
//$router->addPut(
//    "/events/edit/{id:[0-9]+}/{name:[a-zA-Z0-9\-]+}/{type:[a-zA-Z0-9\-]+}/{date:[a-zA-Z0-9\-]+}/{startTime:[0-9]+}/{endTime:[0-9]+}",
//    "Event::updateEvent"
//
//);
//
////get a particular event based on id
//$router->addGet(
//    "/events/info/{id:[0-9]+}",
//    "Event::getEventInfo"
//);
//
////get event based on name
//$router->addGet(
//    "/events/info/{id:[a-z\-]+}",
//    "Event::findEventByName"
//);
//
//get all events
//$router->addGet(
//    "/events/all",
//    "Event::getAll"
//);
//
////delete event
//$router->addDelete(
//    "/events/delete/{id:[0-9]+}",
//    "Event::deleteEvent"
//);




//GET VERB - GET ELEMENT
//Get elemets of relationship. Ex: /department/2/user
//$router->addGet('/:controller/:int/([a-zA-Z0-9_-]+)', array(
//    'controller'    => 1,
//    'action'        => "list",
//    'id'            => 2,
//    'relationship'  => 3
//));
////Get one element. Ex: /user/2
//$router->addGet('/:controller/:int', array(
//    'controller' => 1,
//    'action'     => "get",
//    'id'         => 2
//));
////Get all elements. Ex: /user
//$router->addGet('/:controller', array(
//    'controller' => 1,
//    'action'     => "list"
//));
//
////POST VERB - CREATE ELEMENT
////Create a new element. Ex: /user
//$router->addPost('/:controller', array(
//    'controller' => 1,
//    'action'     => "save"
//));
//
////PUT VERB - UPDATE ELEMENT
////Update a new element. Ex: /user
//$router->addPut('/:controller/:int', array(
//    'controller' => 1,
//    'action'     => "save",
//    'id'         => 2
//));
//
//
////DELETE VERB - UPDATE ELEMENT
////Update a new element. Ex: /user
//$router->addDelete('/:controller/:int', array(
//    'controller' => 1,
//    'action'     => "delete",
//    'id'         => 2
//));
//
//
////not founded route
//$router->notFound(array(
//    'controller' => 'error',
//    'action' => 'page404'
//));
//
//$router->setDefaults(array(
//    'controller' => 'index',
//    'action' => 'index'
//));

//return $router;



return $router;

