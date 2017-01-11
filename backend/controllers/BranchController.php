<?php
use \Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\DI;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\Query;
class BranchController extends ControllerBase
{

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

