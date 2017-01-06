<?php

/**
 * Created by PhpStorm.
 * User: kouakam
 * Date: 14.12.2016
 * Time: 15:23
 */
use Phalcon\Mvc\Controller;
class UserEventController extends ControllerBase
{
    /**
     * search all event organize by a given user

     * @param $id_user
     */
  public function searchEventAction($id_user)
  {
       $events=UserEvent::find($id_user);
       return $this->extractData($events);
  }

    /**
     * add and event organise by a given user
     * @param $id_event
     * @param $id_user
     */
  public function addEventAction($id_event,$id_user)
  {
    $newevent= new UserEvent();
    $newevent->setIdEvent($id_event);
    $newevent->setIdUser($id_user);
    if ($newevent->save()==true)
    {

    }
    else
    {

    }
  }
}