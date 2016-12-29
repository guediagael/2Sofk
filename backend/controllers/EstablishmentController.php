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



    public function indexAction(){

    }

    public function initialize(){
        $this->response= new Response();
    }



    /**
     * @Post("/institution/new")
     *
     */

    public function addAction($name,$rating=null,$address,$city,$district=null ,$description=null){


       try{

           $chat= new Chat();
           $chat->setChatName($name);
           $chat->save();
           echo "processing";


           echo "till here";


           $establishment= new Establishment();
           $establishment->setEstablishmentName($name);
           $establishment->setAddress($address);
           $establishment->setCity($city);
           $establishment->setRating($rating);
           $establishment->setDescription($district);
           $establishment->setDistrict($description);
           $establishment->setChatId($chat->getChatId());
           echo "wb here";
           $establishment->save();
       }catch (ErrorException $e){
           echo $e;

       }


    }

    public function editAction($id,$name=null,$rating=null,$address=null,$city=null,$district=null ,$description=null){

        try{

            if ($description==null){
                echo "sorry you should edit at least the description to achieve this action";
            }else{
                $institution = Institution::find($id);

                $institution->setName($name);
                $institution->setAddress($address);
                $institution->setCity($city);
                $institution->setRating($rating);
                $institution->setDescription($district);
                $institution->setDistrict($description);
                $institution->save();

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

        $institution= Institution::find($id);
        $institution->delete();
        return $this->response->setJsonContent("success!");


    }


}