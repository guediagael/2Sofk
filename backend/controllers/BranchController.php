<?php
<<<<<<< b9484750bfa42f4c4aa26faba5ce3a216cf06289
use \Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\DI;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\Query;
class BranchController extends ControllerBase
{
=======
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

>>>>>>> 3afa0e71229b23762163eb911c1c2545849a920f

    public function indexAction()
    {

    }

    /**
     * @param $establishment the id of the institution
     * @param $city
     * @param null $district
     * @param null $description
     * @param $lon the longitude where the institution is situated
     * @param $la the latitude where the institution is situated
     * @param null $rating the average rating of the institution
     * @param $chatname  the chat id
     */
    public function addBranchAction($establishment,$city,$lon,$la,$chatname,$district,$rating=null,$description=null)
    {
        echo "in \n";
        try{

            $chat=new Chat();
            $chat->setChatName($chatname);
            $testchat=$chat->save();
           if ($testchat==true)
            {
             $esta=Establishment::findFirstByName($establishment);
                echo "in try\n";

               /* $psql="INSERT INTO branch (establishment_id, city, district,description,longitude,latitude,rating,chat_id)
                         VALUES (:id:,:city:,:district:,:description:,:long:,:lat:,:rate:,:chat:)";
                    $test=$this->modelsManager->executeQuery(
                        $psql,
                        [
                            "id" => $esta->getEstablishmentId(),
                            "city" => $city,
                            "district" => $district,
                            "description" => $description,
                            "long" => $lon,
                            "lat" => $la,
                            "rate" => $rating,
                            "chat" => $chat->getChatId()
                        ]
                    );*/
               $branch=new Branch();
                 $branch->setChatId($chat->getChatId());
                 $branch->setEstablishmentId($esta->getEstablishmentId());
                 $branch->setDescription($description);
                 $branch->setLongitude($lon);
                 $branch->setLatitude($la);
                 $branch->setRating($rating);
                 $branch->setCity($city);
                 $branch->setDistrict($district);
                 $test=$branch->save();
                   if ($test==false)
                   {
                       $todelete=Chat::findFirst($chat->getChatId());
                       echo "deleting chat";
                       $todelete->delete();
                       $messages=$test->getMessages();
                        foreach ($messages as $message)
                       {
                           echo $message->getMessage();
                       }

                   }

            }
            elseif ($testchat==false)
            {
                echo "fail";
                $messages=$chat->getMessages();
                foreach ($messages as $message)
                {
                    echo "message",$message->getMessage();
                }
            }
        }catch (ErrorException $ex)
        {
            echo $ex;
        }
    }

    public function deleteAction($id,$city,$district)
    {
       // $phql=" SELECT * FROM establishment WHERE establishment_id=:id:";
 echo "in \n";
   $condition=['id' => $id,'city'=> $city, 'district' =>$district];
        $todelete=Branch::findFirst(
        [
            'conditions' => 'establishment_id=:id: and city=:city: and district=:district:',
            'bind' => $condition
        ]);
      /*  $todelete=$this->modelsManager->executeQuery($phql,
                ['id' => $id
                ]);*/

         if($todelete==null)
         {
             echo "not such a branch in the table \n";
             return ;
         }
         else
         {

           //  $ph="delete from branch WHERE "
             if($todelete->delete())
             {
              echo "element deleted \n";
             }
             else
             {
                 echo "element not deleted\n";
             }
         }
    }
}

=======
    public function initialize(){
        $this->response = new Response();

    }

    public function addAction($establishment_id, $city, $district, $description, $longitude=null, $latitude=null, $rating=null)
    {
        //TODO: Check what's wrong with chat creation here

        $establishmentName = Establishment::findFirst($establishment_id)->getEstablishmentName();
        $separator = "|";
        $chatName = ($establishmentName.$separator.$district);

        $chat = new Chat();
        $chat->setChatName($chatName);


        if ($chat->save()===false){
//           foreach ($chat->getMessages() as $message){
//               echo $message->getMessage();
           $this->response->setJsonContent([
               "status"=>"ERROR",
               "data"=>$chat->getMessages(),
           ]);
        //   }
       }else{


           //   echo "up to branch";
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
        echo "here";

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
>>>>>>> 3afa0e71229b23762163eb911c1c2545849a920f
