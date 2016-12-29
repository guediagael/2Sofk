<?php
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Di;

/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 14/12/2016
 * Time: 14:16
 */
class EventOrganizatorController extends Controller
{

    private $response;
    
    
    
    public function indexAction(){
        
    }

    public function initialize()
    {
        $this->response= new Response();
        
    }

//    public function addAction($event_id,$institution_id)
//    {
//        $organizator= new EventOrganizator();
//        $organizator->setEventId($event_id);
//        $organizator->setInstitutionId($institution_id);
//
//        if($organizator->save()=== false){
//            return $this->response->setJsonContent($organizator->getMessages());
//        }
//
//    }



}