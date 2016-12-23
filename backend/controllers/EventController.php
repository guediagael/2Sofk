<?php

/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 14/12/2016
 * Time: 14:16
 */
//namespace Tusofk\backend;

use Phalcon\Mvc\Controller;
//use Phalcon\Mvc\Router\Annotations as RouterAnnotations;

/*
     * @RoutePrefix("/tusofk/events")
     */

class EventController extends Controller
{


    /**
     * @Get("/")
     */

    public function indexAction(){

    }

    /**
     * @Post("/events/new")
     *
     */
    public function newEventAction($eventName,$type,$date,$startTime,$endTime){

        $event = new Event();
        $event->setEventName($eventName);
        $event->setType($type);
        $event->setDate($date);
        $event->setBegin($startTime);
        $event->setEnd($endTime);
        $event->save();

    }

    /**
     * @Put("/events/edit/{id}")
     */

    public function updateEventAction($id,$eventName,$type,$date,$startTime,$endTime){

        $event=Event::findFirst($id);
        $event->setEventName($eventName);
        $event->setType($type);
        $event->setDate($date);
        $event->setBegin($startTime);
        $event->setEnd($endTime);
        $event->save();

    }

    /**
     * @Get("events/info/{id}")
     */
    public function getEventInfoAction($id){
        $event = Event::findFirst($id);
        return $event->getEventInfo($id);
        //return extractData(Event::findFirst($id));

    }

    /**
     * @Get("events/all")
     */
    public function getAllEventsAction(){

        echo "Test";
      //  return printf("Test test");
        return  new response(json_encode(Event::find()));
    }


    /**
     * @Delete("events/delete/{id}")
     */
    public function deleteEventAction($id){

        $event = Event::findFirst($id);
        $event->delete();
    }

    /**
     * @Get("events/search/{name}")
     */
    public function findEventByName($name){
        return json_encode(Event::find($name));

    }



}