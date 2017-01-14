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
       // echo "how?";
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
                   // $this->response->setJsonContent($organizator->getMessages());
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

        echo 'hi';
        $event = Event::findFirst($id);
        $event->setEventName($eventName);
        $event->setType($type);
        $event->setDate($date);
        $event->setBegin($startTime);
        $event->setEnd($endTime);
        $event->setDescription($description);
        // $event->save();
        if ($event->save() == false) {
            foreach ($event->getMessages() as $msg) {
                echo $msg->getMessage();
            }
        }

    }

    /**
     * @Get("events/info/{id}")
     */
    public function getInfoAction($id)
    {
        //  $event = Event::findFirst($this->id);
        $event = Event::findFirst($id);

        return $this->response->setJsonContent($event);

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

        if ($event->delete() == false) {
            foreach ($event->getMessages() as $message) {
                echo $message->getMessage();
            }
        } else {
            return $this->response->setJsonContent("success");
        }
    }


        /**
         * @Get("events/search/{name}")
         */
        public  function findByNameAction($name)
        {
            return json_encode(Event::find($name));

        }


}



