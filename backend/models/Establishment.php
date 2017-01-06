<?php

class Establishment extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $establishment_id;

    /**
     *
     * @var string
     * @Column(type="string", length=70, nullable=false)
     */
    protected $name;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $description;

    /**
     * Method to set the value of field establishment_id
     *
     * @param integer $establishment_id
     * @return $this
     */
    public function setEstablishmentId($establishment_id)
    {
        $this->establishment_id = $establishment_id;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setEstablishmentName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Returns the value of field establishment_id
     *
     * @return integer
     */
    public function getEstablishmentId()
    {
        return $this->establishment_id;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getEstablishmentName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("project_bd");
        $this->hasMany('establishment_id', 'Branch', 'establishment_id', ['alias' => 'Branch']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'establishment';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Establishment[]|Establishment
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Establishment
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
