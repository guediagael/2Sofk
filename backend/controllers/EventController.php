<?php
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Di;
use Phalcon\Http\Response;

//use Phalcon\Mvc\Router\Annotations as RouterAnnotations;

/*
     * @RoutePrefix("/tusofk/events")
     */

class EventController extends Controller
{

    private $response;

  //  private $id;

   // private $params;

    /**
     * @Get("/")
     */

    public function indexAction(){

    }

    public function initialize()
    {
        $this->response=new Response();
      //  $this->id= $this->dispatcher->getParam('id');

    }

    /**
     * @Post("/events/new")
     *
     */
    public function addAction($establishment_id, $eventName, $type, $date, $startTime, $endTime,$description){

        try{

        echo "process";
            //if (Establishment::find($establishment_id)!=null) {
                $chat = new Chat();
                $chat->setChatName($eventName);
               // $chat->save();
            if ($chat->save()==false){
                foreach ($chat->getMessages() as $msg){
                    echo $msg->getMessage();
                }
            }

            echo "after save";
                $event = new Event();
                $event->setEventName($eventName);
                $event->setType($type);
                $event->setDate($date);
                $event->setBegin($startTime);
                $event->setEnd($endTime);
                $event->setDescription($description);


                $event->setEstablishmentId($establishment_id);

                $event->setChatId($chat->getChatId());

              //  $event->save();
            if ($event->save()==false){
                foreach ($event->getMessages() as $msg){
                    echo $msg->getMessage();
                }
            }

                $organizator= new EventOrganizator();
                $organizator->setEventId($event->getEventId());
                $organizator->setEstablishmentId($event->getEstablishmentId());
               // $organizator->save();

            if ($organizator->save()==false){
                foreach ($organizator->getMessages() as $msg){
                    echo $msg->getMessage();
                }
            }
//            }else{
//                echo "somin' wrong";
//            }

            //echo "processing";




        }catch (ErrorException $e){
            echo $e;
        }


    }

    /**
     * @Put("/events/edit/{id}")
     */

    public function updateAction($id,$eventName,$type,$date,$startTime,$endTime,$description){

        echo 'hi';
        $event=Event::findFirst($id);
        $event->setEventName($eventName);
        $event->setType($type);
        $event->setDate($date);
        $event->setBegin($startTime);
        $event->setEnd($endTime);
        $event->setDescription($description);
       // $event->save();
        if ($event->save()==false){
            foreach ($event->getMessages() as $msg){
                echo $msg->getMessage();
            }
        }

    }

    /**
     * @Get("events/info/{id}")
     */
    public function getInfoAction($id){
      //  $event = Event::findFirst($this->id);
        $event = Event::findFirst($id);

       return $this->response->setJsonContent($event);

    }

    /**
     * @Get("events/all")
     */
    public function getAllAction(){

        echo "Test";
      //  return printf("Test test");
       // return  new response(json_encode(Event::find()));
        $data= Event::find();
        return $this->response->setJsonContent($data);
       // return $this->response;
    }


    /**
     * @Delete("events/delete/{id}")
     */
    public function deleteAction($id){

        $event = Event::findFirst($id);

        if ($event->delete()==false){
            foreach ($event->getMessages() as $message){
                echo $message->getMessage();
            }
        }else{
            return $this->response->setJsonContent("success");
        }

    }

    /**
     * @Get("events/search/{name}")
     */
    public function findByNameAction($name){
        return json_encode(Event::find($name));

    }



}