<?php
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Di;
use Phalcon\Http\Response;
/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 31/12/2016
 * Time: 11:47
 */




class BranchController extends Controller
{
    private $response;


    public function indexAction()
    {

    }





    public function initialize(){
        $this->response = new Response();

    }

    public function addAction($establishment_id, $city, $district, $description, $longitude=null, $latitude=null, $rating=null)
    {


        $establishmentName = Establishment::findFirst($establishment_id)->getEstablishmentName();
        $separator = "|";
        $chatName = ($establishmentName.$separator.$district);

        $chat = new Chat();
        $chat->setChatName($chatName);


        if ($chat->save()===false){

           $this->response->setJsonContent([
               "status"=>"ERROR",
               "data"=>$chat->getMessages(),
           ]);

       }else{



           $branch = new Branch();
           $branch->setEstablishmentId($establishment_id);
           $branch->setCity($city);
           $branch->setDistrict($district);
           $branch->setDescription($description);
           $branch->setLongitude($longitude);
           $branch->setLatitude($latitude);
           $branch->setRating($rating);
           $branch->setChatId($chat->getChatId());


           if ($branch->save()===false){

               $this->response->setJsonContent($branch->getMessages());
           }else{
               $this->response->setJsonContent([
                   "status"=>"added"
               ]);
           }



       }

       return $this->response;

    }



    public function editAction($establishment_id, $city, $district, $description, $longitude=null, $latitude=null, $rating=null)
    {

        $branch = Branch::findFirst(
            [
                'conditions'=>'establishment_id= ?1 AND city= ?2 AND district = ?3',
                'bind'=>[
                    1=>$establishment_id,
                    2=>$city,
                    3=>$district
                ]
            ]
        );

        if ($branch===false){
            $this->response->setJsonContent(
                [
                    "status"=>"NOT FOUND"
                ]
            );
        }else{
            $branch->setDescription($description);
            $branch->setLongitude($longitude);
            $branch->setLatitude($latitude);
            $branch->setRating($rating);
            if ($branch->save()===false){

                $this->response->setJsonContent($branch->getMessages());
            }else{
                $this->response->setJsonContent(
                    [
                        "status"=>"CHANGES SAVED"
                    ]
                );
            }
        }
        return $this->response;
    }


    public function findAction($establishment_id, $city, $district)
    {


        $branch= Branch::findFirst(
            [

                'conditions' => 'establishment_id= ?1 AND city=?2 AND district= ?3',
                'bind' =>[
                    1=>$establishment_id,
                    2=>$city,
                    3=>$district
                ]
            ]
        );


        if ($branch === false) {
            $this->response->setJsonContent(
                [
                    "status" => "NOT-FOUND"
                ]
            );
        } else {
            $this->response->setJsonContent(
                [
                    "status" => "FOUND",
                    "data"   => [
                        $branch
                    ]
                ]
            );
        }


       return $this->response;
    }

    public function deleteAction($establishment_id,$city,$district)
    {
        $branch= Branch::findFirst(
            [
                'conditions'=>'establishment_id = ?1 AND city= ?2 AND district = ?3',
                'bind'=>[
                    1=>$establishment_id,
                    2=>$city,
                    3=>$district
                ]
            ]
        );

        if ($branch===false){
            $this->response->setJsonContent(
                [
                    "status"=>"the branch you want to delete doesn't exist"
                ]
            );
        }elseif (Branch::count($establishment_id)==1){
            $this->response->setJsonContent(
                [
                    "status"=>"You can't have an establishment with no branch"
                ]
            );
        }else{
            $chat = Chat::findFirst($branch->getChatId());
            if ($branch->delete()===false ){
               $this->response->setJsonContent($branch->getMessages());
            }else{

               if ($chat->delete()===false){
                   $this->response->setJsonContent($chat->getMessages());
               }else{
                   $this->response->setJsonContent(
                       [
                           "status"=>"successfully deleted"
                       ]
                   );
               }


            }
        }
        return $this->response;
    }



}


