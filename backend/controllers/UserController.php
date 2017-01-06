<?php

/**
 * Created by PhpStorm.
 * User: kouakam
 * Date: 14.12.2016
 * Time: 14:46
 */
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\DI;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\Query;
//use Sofk\Models\User;

class UserController extends ControllerBase
{
    public function indexAction()
    {

    }
    /*
     * find all user in the data base
     */
    public function searchAction($id=null)
    {
          //$user= $this->dispatcher->getControllerName();
          $data=User::find($id);
          return $this->extractData($data);
    }

    /*
     * delete user in the database knowing is id
     */
     public function deleteAction($user_id)
     {
             $key=$user_id;
            // $exists=$this->view->getCache()->exists($key);

                 $phql='delete from User  WHERE user_id='.$key.' ';
                $this->modelsManager->executeQuery($phql);



     }

    /**
     * add a new user in the database
     * @param $nickname the nickname of the user
     * @param $email
     * @param $phone
     * @param $pass the password
     */
     public function addAction($nickname,$email,$phone,$pass)
     {

           $newuser=new User();
            $newuser->setEmail($email);
            $newuser->setNickname($nickname);
            $newuser->setPhone($phone);
            $newuser->setPassword($pass);
            $test=$newuser->save();
            if($test==false)
            {
                $message=$newuser->getMessages();
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

    /** update the user with the id @link: user_id
     * @param $oldnick
     * @param $newnick
     */
     public function updatenickAction($oldnick,$newnick)
     {

       $phql = "update User set nickname=:nick: WHERE nickname=:old:";
       $result=$this->modelsManager->executeQuery($phql,
           [
               "nick" => $newnick,
               "old" =>$oldnick
           ]
       );

       if ($result->success()==false)
       {
           $mes=$result->getMessages();
           foreach ($mes as $message )
           {   echo "Error Message",PHP_EOL;
               echo "Message: ",$message->getMessage(); echo PHP_EOL;
               echo "Field: ",$message->getField(); echo PHP_EOL;
               echo "Type: ",$message->getType(); echo PHP_EOL;
           }
       }

     }

    /**
     * @param $username
     * @param $pass
     * @return mixed
     */
 public function registerAction($username=null,$pass)
 {

     $result=User::findFirstByNickname($username);
      if($result==null)
      {
          echo "user name incorrect";
          return ;
      }
      else
      {
          $password=$result->getPassword();
          if($password==$pass)
          {
              echo "connection establish";
          }
          else
              {
                  echo " incorrect user name and password";
              }
      }



 }

}