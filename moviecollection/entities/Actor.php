<?php namespace moviecollection\entities;

use \DateTime;
use \JsonSerializable;
use moviecollection\entities\{Entity,EntityInterface};

/**
 * Actor
 *
 * @uses      Entity
 * @uses      EntityInterface
 * @package   moviecollection\entities
 * @version   1.0
 * @copyright 2016
 * @author    Matthew Round <roundyz32@gmail.com>
 * @license   All rights and ownership reserved
 */
class Actor extends Entity implements EntityInterface, JsonSerializable
{


    /**
     * name
     *
     * The actors name
     *
     * @var string
     * @access private
     */
    private $name;


    /**
     * dob
     *
     * The actors Date of Birth
     *
     * @var \DateTime
     * @access private
     */
    private $dob;


    /**
     * isBornBefore
     *
     * Checks to see if an actor is born before a date
     *
     * @param \DateTime $when The date to check against
     *
     * @access public
     * @return bool
     */
    public function isBornBefore(\DateTime $when): bool
    {

        $actorBornYet = false;
        $actorDob = $this->getDob();
        $interval = $when->diff($actorDob);
        $intervalStr = $interval->format('%R%a');
        $actorBornYet = $intervalStr <= -1;
        return $actorBornYet;
    }


    /**
     * generateUUID
     *
     * Generates a uuid for this actor
     *
     * @access protected
     * @return string
     */
    public function generateUUID() : string
    {
        $str = $this->name . $this->dob->format('Y-M-d');
        $hash = md5($str);
        return $hash;
    }


    /**
     * __construct
     *
     * Contstructor
     *
     * @access private
     * @return void
     */
    private function __construct()
    {
        $this->name = "";
        $this->dob = new DateTime();
    }


    /**
     * getName
     *
     * Gets the actors name
     *
     * @access public
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }


    /**
     * getDob
     *
     * Gets the actors Date of birth
     *
     * @access public
     * @return \DateTime
     */
    public function getDob() : DateTime
    {
        return $this->dob;
    }


    /**
     * setName
     *
     * Sets the actors name
     *
     * @param string $name The name to set
     * @access public
     * @return void
     */
    public function setName($name = "")
    {
        $nameOk = strlen($name) >= 3;
        if ($nameOk) {
            $this->name = $name;
        } else {
            throw new \Exception("Actor's name too short");
        }
    }


    /**
     * setDob
     *
     * Sets the Date of birth
     *
     * @param \DateTime $dob The Date of birth to set
     * @access public
     * @return void
     */
    public function setDob(\DateTime $dob)
    {
        $now = new DateTime();
        $hasBeenBornYet = $dob <= $now;
        if ($hasBeenBornYet) {
            $this->dob = $dob;
        } else {
            throw new \Exception("Actor Not yet born");
        }
    }


    /**
     * generate
     *
     * Generates and actor based on args
     *
     * @param string    $name The name of the actor
     * @param \DateTime $dob  The date of birth
     * @static
     * @access public
     * @return \moviecollection\entities\Actor
     */
    public static function generate($name, $dob) : Actor
    {
        $self = new self();
        try {
            $self->setName($name);
            $self->setDob($dob);
            $self->getUUID();
        } catch (Execption $e) {
            printf("Error:%s", $e->getMessage());
        }
        return $self;
    }


    /**
     * jsonSerialize
     *
     * represents this as json
     *
     * @access public
     * @return \StdClass
     */
    public function jsonSerialize() : \StdClass
    {
        $ob = new \StdClass();
        $ob->name = $this->name;
        $ob->dob = $this->dob->format('Y-M-d');
        return $ob;
    }
}
