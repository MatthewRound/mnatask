<?php namespace moviecollection\entities;

/**
 * Holds the class moviecollection/entities/Actor.php
 *
 * PHP version 5
 *
 * @category Core
 * @package  moviecollection/entities/Actor.php
 * @author   Matthew Round <roundyz32@gmail.com>
 * @license  (All rights and ownership reserved)
 * @link
 *
 */

use \DateTime;
use moviecollection\entities\Entity;
use moviecollection\entities\EntityInterface;

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
class Actor extends Entity implements EntityInterface
{


    /**
     * name
     *
     * @var mixed
     * @access private
     */
    private $name;


    /**
     * dob
     *
     * @var mixed
     * @access private
     */
    private $dob;


    /**
     * generateUUID
     *
     * @access public
     * @return void
     */
    public function generateUUID()
    {
        $str = $this->name . $this->dob->format('Y-M-d');
        $hash = md5($str);
        return $hash;
    }


    /**
     * __construct
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
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * getDob
     *
     * @access public
     * @return void
     */
    public function getDob()
    {
        return $this->dob;
    }


    /**
     * setName
     *
     * @param string $name
     * @access public
     * @return void
     */
    public function setName($name = "")
    {
        $nameOk = strlen($name) >= 3;
        if ($nameOk) {
            $this->name = $name;
        }
    }


    /**
     * setDob
     *
     * @param \DateTime $dob
     * @access public
     * @return void
     */
    public function setDob(\DateTime $dob)
    {
        $now = new DateTime();
        $interval = $now->diff($dob);
        $intervalStr = $interval->format('%R%a');
        $hasBeenBornYet = $intervalStr <= -1;
        if ($hasBeenBornYet) {
            $this->dob = $dob;
        } else {
            throw new \Exception("Actor Not yet born");
        }
    }


    /**
     * generate
     *
     * @param mixed $name
     * @param mixed $dob
     * @static
     * @access public
     * @return void
     */
    public static function generate($name, $dob)
    {
        $self = new self();
        try {
            $self->setName($name);
            $self->setDob($dob);
            $self->getUUID();
        } catch (Execption $e) {
            sprintf("Error:%s", $e->getMessage());
        }
        return $self;
    }


    /**
     * toJson
     *
     * @access public
     * @return void
     */
    public function toJson()
    {
        $ob = new \StdClass();
        $ob->name = $this->name;
        $ob->dob = $this->dob->format('Y-M-d');
        return json_encode($ob);
    }
}
