<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Resultset;
class ControllerBase extends Controller
{
    public function extractData($data){
        //extracting data to array
        $data->setHydrateMode(Resultset::HYDRATE_ARRAYS);
        $result = array();
        foreach( $data as $value ){
            $result[] = $value;
        }

        $this->response->setJsonContent($result);
        return $this->response;
    }
}
