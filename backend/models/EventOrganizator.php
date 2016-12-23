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
    private $institution_id;
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
    public function getInstitutionId()
    {
        return $this->institution_id;
    }

    /**
     * @param mixed $institution_id
     */
    public function setInstitutionId($institution_id)
    {
        $this->institution_id = $institution_id;
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