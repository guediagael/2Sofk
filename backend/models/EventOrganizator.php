<?php

/**
 * Created by PhpStorm.
 * User: TheLetch
 * Date: 13/12/2016
 * Time: 18:28
 */

use Phalcon\Mvc\Model;
class EventOrganizator extends Model
{

    private $event_id;
    private $establishment_id;
    private $rating;




    /**
     * @return mixed
     */
    public function getEventId()
    {
        return $this->event_id;
    }

    /**
     * @param mixed $event_id
     */
    public function setEventId($event_id)
    {
        $this->event_id = $event_id;
    }

    /**
     * @return mixed
     */
    public function getEstablishmentId()
    {
        return $this->establishment_id;
    }

    /**
     * @param mixed $establishment_id
     */
    public function setEstablishmentId($establishment_id)
    {
        $this->establishment_id = $establishment_id;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }


}