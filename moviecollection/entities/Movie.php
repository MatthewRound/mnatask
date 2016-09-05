<?php namespace moviecollection\entities;

/**
 * Holds the class moviecollection/entities/Movie.php
 *
 * PHP version 5
 *
 * @category Core
 * @package  moviecollection/entities/Movie.php
 * @author   Matthew Round <roundyz32@gmail.com>
 * @license  (All rights and ownership reserved)
 * @link
 *
 */

use \DateTime;
use moviecollection\entities\Actor;
use moviecollection\entities\EntityInterface;

/**
 * Movie
 *
 * @uses      Entity
 * @uses      EntityInterface
 * @package   moviecollection\entities
 * @version   1.0
 * @copyright 2016
 * @author    Matthew Round <roundyz32@gmail.com>
 * @license   All rights and ownership reserved
 */
class Movie extends Entity implements EntityInterface
{


    /**
     * title
     *
     * @var mixed
     * @access private
     */
    private $title;


    /**
     * runtime
     *
     * @var mixed
     * @access private
     */
    private $runtime;


    /**
     * releaseDate
     *
     * @var mixed
     * @access private
     */
    private $releaseDate;


    /**
     * actors
     *
     * @var []
     * @access private
     */
    private $actors;


    /**
     * addActor
     *
     * @param string $charecter
     * @param Actor $actor
     * @access public
     * @return void
     */
    public function addActor(Actor $actor, $charecter = "Character")
    {
        $actorBornYet = false;
        $actorDob = $actor->getDob();
        $releaseDate = $this->releaseDate;
        $interval = $this->releaseDate->diff($actorDob);
        $intervalStr = $interval->format('%R%a');
        $actorBornYet = $intervalStr <= -1;
        if ($actorBornYet) {
            $this->actors[$charecter] = $actor;
        } else {
            throw new \Exception("Actor Born After Movie Release");
        }
    }


    /**
     * getActors
     *
     * @param mixed $sortByAge
     * @access public
     * @return void
     */
    public function getActors($sortByAge = false)
    {
        if ($sortByAge) {
            usort($this->actors, 'moviecollection\entities\Movie::compareActors');
        }
        return $this->actors;
    }


    /**
     * CompareActors
     *
     * @param mixed $a
     * @param mixed $b
     * @static
     * @access public
     * @return void
     */
    public static function compareActors($a, $b)
    {
        return $a->getDob()->diff($b->getDob())->format('%R%a') <= 0;
    }


    /**
     * generateUUID
     *
     * @access public
     * @return void
     */
    public function generateUUID()
    {
        $str = $this->title . $this->releaseDate->format("Y-m-d") . $this->runtime;
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
        $this->title = "";
        $this->runtime = 60;
        $this->releaseDate = new DateTime();
        $this->actors = [];
    }


    /**
     * generate
     *
     * @param DateTime $releaseDate
     * @param string $title
     * @param int $runtime
     * @static
     * @access public
     * @return void
     */
    public static function generate(DateTime $releaseDate, $title = '', $runtime = 60)
    {
        try {
            $self = new self();
            $self->setTitle($title);
            $self->setRuntime($runtime);
            $self->setReleaseDate($releaseDate);
            $self->getUUID();
        } catch (Execption $e) {
            sprintf("Error:%s", $e->getMessage());
        }
        return $self;
    }


    /**
     * setTitle
     *
     * @param string $title
     * @access public
     * @return void
     */
    public function setTitle($title = "")
    {
        $len = strlen($title);
        $tooShort = $len <= 3;
        $tooLong = $len >= 200;
        $titleLengthOk = !$tooLong && !$tooShort;
        if ($titleLengthOk) {
            $this->title = $title;
        } else {
            throw new \Exception("Title length invalid");
        }
    }


    /**
     * setRuntime
     *
     * @param int $runtime
     * @access public
     * @return void
     */
    public function setRuntime($runtime = 60)
    {
        $tooShort = $runtime <= 1;
        $tooLong = $runtime >= 400;
        $lengthOk = !$tooLong && !$tooShort;
        if ($lengthOk) {
            $this->runtime = $runtime;
        } else {
            throw new \Exception("Runtime length invalid");
        }
    }


    /**
     * setReleaseDate
     *
     * @param DateTime $releaseDate
     * @access public
     * @return void
     */
    public function setReleaseDate(DateTime $releaseDate)
    {
        $this->releaseDate = $releaseDate;
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
        $ob->title = $this->title;
        $ob->runtime = $this->runtime;
        $ob->releaseDate = $this->releaseDate->format('Y-M-d');
        $ob->actors = [];
        foreach ($this->actors as $role => $actor) {
            $ob->actors[$role] = $actor->toJson();
        }
        return json_encode($ob);
    }
}
