<?php
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Di;
use Phalcon\Http\Response;
use Phalcon\Mvc\Resultset;
use Phalcon\Mvc\Model\Query;

class EventController extends Controller
{


    private $response;


    public function indexAction()
    {

    }

    public function initialize()
    {
        $this->response = new Response();


    }

    public function addAction($establishment_id, $eventName, $type, $date, $startTime, $endTime, $description)
    {

        $chat = new Chat();
        $chat->setChatName($eventName);
        if ($chat->save()===false) {

            $this->response->setJsonContent([
                "status"=>"ChatCreation error",
                "data"=>$chat->getMessages(),
            ]);

        } else {
            $event = new Event();
            $event->setEventName($eventName);
            $event->setType($type);
            $event->setDate($date);
            $event->setBegin($startTime);
            $event->setEnd($endTime);
            $event->setDescription($description);
            $event->setEstablishmentId($establishment_id);
            $event->setChatId($chat->getChatId());

            if ($event->create() === false) {
                $chat->delete();
                $this->response->setJsonContent([
                    "status"=>"eventCreation error",
                    "data"=>$event->getMessages(),
                ]);
            } else {
                $organizator = new EventOrganizator();
                $organizator->setEventId($event->getEventId());
                $organizator->setEstablishmentId($event->getEstablishmentId());

                if ($organizator->create()===false) {
                    $chat->delete();
                    $event->delete();
                    $this->response->setJsonContent([
                        "status"=>"OrganizatorCreation error",
                        "data"=>$organizator->getMessages(),
                    ]);

                }else{
                    $this->response->setJsonContent([
                        "status"=>"OK",
                        "data"=>"Event Added"
                    ]);
                }
            }


        }

        return $this->response;
    }




    public function updateAction($id, $eventName, $type, $date, $startTime, $endTime, $description)
    {

        echo "test";

        $event = Event::findFirst($id);

        if ($event!=false){
            $event->setEventName($eventName);
            $event->setType($type);
            $event->setDate($date);
            $event->setBegin($startTime);
            $event->setEnd($endTime);
            $event->setDescription($description);

            if ($event->update() === false) {
                $msg="";
                foreach ($event->getMessages() as $message) {
                    $msg = $msg."" . $message;
                }
                $this->response->setJsonContent([
                    "status"=>"ERROR",
                    "data"=>$msg//$event->getMessages()
                ]);
            }
        }else{
            $this->response->setJsonContent([
                "status"=>"NOT FOUND",
                "data"=>"The event you try to access doesn't exist"
            ]);
        }

        return $this->response;

    }

    /**
     * @Get("events/info/{id}")
     */
    public function getInfoAction($id)
    {

        $event = Event::findFirst($id);
        if ($event===false){
            $this->response->setJsonContent([
                "status"=>"NOT FOUND",
                "data"=>"The event you're looking for doesn't exist"
            ]);
        }else{
            $this->response->setJsonContent([
                "status"=>"FOUND",
                "data"=>$event
            ]);
        }

        return $this->response;

    }

    /**
     * @Get("events/all")
     */
    public function getAllAction()
    {

        echo "Test";
        //  return printf("Test test");
        // return  new response(json_encode(Event::find()));
        $data = Event::find();
        return $this->response->setJsonContent($data);
        // return $this->response;
    }


    /**
     * @Delete("events/delete/{id}")
     */
    public function deleteAction($id)
    {

        $event = Event::findFirst($id);

        if ($event!=false){
            if ($event->delete() === false) {
                $this->response->setJsonContent([
                    "status"=>"ERROR!!",
                    "data"=>$event->getMessages(),
                ]);
            } else {
                $this->response->setJsonContent([
                    "status"=>"OK",
                    "data"=>"Event deleted"


                ]);
            }
        }else{
            $this->response->setJsonContent(
                [
                    "status"=>"NOT FOUND",
                    "data"=>"The event you try to delete doesn't exist"
                ]
            );
        }

        return $this->response;
    }


        /**
         * @Get("events/search/{name}")
         */
        public  function findByNameAction($name)
        {
            return json_encode(Event::find($name));

        }


}



