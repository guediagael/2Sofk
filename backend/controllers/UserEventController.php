<?php

/**
 * Created by PhpStorm.
 * User: kouakam
 * Date: 14.12.2016
 * Time: 15:23
 */
use Phalcon\Mvc\Controller;
class UserEventController extends Controller
{
  public function searchEventAction($id_event,$id_user)
  {

  }

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