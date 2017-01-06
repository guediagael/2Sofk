<?php
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Di;
use Phalcon\Http\Response;
/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 14/12/2016
 * Time: 14:17
 */
class EstablishmentController extends Controller
{
    private $response;

    private $dispatcher;



    public function indexAction(){

    }

    public function initialize(){
        $this->response= new Response();
       // $this->dispatcher = new Dispatcher();
    }



    /**
     * @Post("/institution/new")
     *
     */

    public function addAction($name,$rating=null,$city,$district=null,$description, $longitude, $latitude){


       try{

//           $chat= new Chat();
//           $chat->setChatName($name);
          // $data = $chat->save();
          //  $chat->save();
//           if ($chat->save == false) {
//               foreach ($chat->getMessages() as $message) {
//                   echo $message->getMessage();
//               }
//           }
           echo "processing";


           echo "till here";


           $establishment= new Establishment();
           $establishment->setEstablishmentName($name);
          // $establishment->setAddress($address);
           //$establishment->setCity($city);
           //$establishment->setRating($rating);
           $establishment->setDescription($description);
           //$establishment->setDistrict($district);
           //$establishment->setChatId($chat->getChatId());
          // $establishment->save();
           echo "wb here";

           if ($establishment->save()==false){
               foreach ($establishment->getMessages() as $message) {
                   echo $message->getMessage();
               }
           }else{

               $branch = new BranchController();
               $branch->addAction($establishment->getEstablishmentId(), $city, $district,$description,$longitude,$latitude,$rating);



//               $this->dispatcher->forward(
//                   [
//                       "controller"=>"Branch",
//                       "action"=>"add",
//                       "params"=>[ $establishment->getEstablishmentId(),$city,$district,$description,$longitude,$latitude,$rating]
//                   ]
//               );
               //return $this->response->setJsonContent("success");
           }
       }catch (ErrorException $e){
           echo $e;

       }


    }

    public function updateAction($id, $name=null, $rating=null, $address=null, $city=null, $district=null , $description=null){

        try{

            if ($description==null){
                echo "sorry you should edit at least the description to achieve this action";
            }else{
                $establishment = Establishment::findFirst($id);

                $establishment->setEstablishmentName($name);
                $establishment->setAddress($address);
                $establishment->setCity($city);
                $establishment->setRating($rating);
                $establishment->setDescription($district);
                $establishment->setDistrict($description);
                $establishment->save();

                return $this->response->setJsonContent("succes");
            }

        }catch (ErrorException $e){
            echo $e;
        }


    }

    public function getInfoAction($id){

        $institution = Institution::find($id);

        return $this->response->setJsonContent($institution);
    }

    public function getAllAction(){

        $data= Institution::find();

        return $this->response->setJsonContent($data);

    }

    public function deleteAction($id){

        echo "got here";

        $establishment= Establishment::findfirst($id);
      //  $establishment->delete();
        if ($establishment->delete()==false){
            foreach ($establishment->getMessages() as $message){
                echo $message->getMessage();
            }
        }else{
            return $this->response->setJsonContent("success!");

        }


    }


}