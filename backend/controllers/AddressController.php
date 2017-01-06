<?php

class AddressController extends ControllerBase
{

    public function indexAction()
    {
        echo "bonjour";
        $this->dispatcher->forward(
            array(
                "controller"=>"index",
                "action"=>"show"
            )
        );
    }

    /**
     * @param $institutio
     * @param $city
     * @param $district
     * @param $descrition
     * @param $lon
     * @param $la
     */
    public function addAddressAction($institutio,$city,$district,$descrition,$lon,$la)
    {
        $newaddress=new Address();
        $newaddress->setCity($city);
        $newaddress->setDescritpion($descrition);
        $newaddress->setDistrict($district);
        $newaddress->setInstitutionId($institutio);
        $newaddress->setLatitude($la);
        $newaddress->setLongitude($lon);

        $test=$newaddress->save();
         if ($test==false)
         {
             $message=$newaddress->getMessages();
             foreach ($message as $msg )
             {
                 echo "Message: ",$msg->getMessage();
                 echo "Message: ",$msg->getField();
                 echo "Message: ",$msg->getType();
             }
         }
         else
         {
             $this->dispatcher->forward(
                 array(
                     "controller"=>"index",
                     "action"=>"show"
                 )
             );
         }

    }

    /**
     * delete
     * @param $id
     */
    public function deleteAddressAction($id)
    {
        $addre= Address::findFirst($id);
        if ($addre->delete()==false)
        {
            foreach ($addre->getMessages() as $message)
            {
                echo $message->getMessage();
            }
        }
        else
        {
            echo " yoooo you did it!";
        }
    }

    /**
     * get the address of and instition
     * @param $id
     * @return mixed
     */
    public function getAddressAction($id)
    {
        $result=Address::find($id);
        return $this->extractData($result);
    }
}

