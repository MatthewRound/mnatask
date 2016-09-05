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
     * The movie title
     *
     * @var String
     * @access private
     */
    private $title;


    /**
     * runtime
     *
     * The movie duration in mins
     *
     * @var int
     * @access private
     */
    private $runtime;


    /**
     * releaseDate
     *
     * The movie release date
     *
     * @var \DateTime
     * @access private
     */
    private $releaseDate;


    /**
     * actors
     *
     * List of actors in this movie
     *
     * @var [\moviecollection\entities\Actor]
     * @access private
     */
    private $actors;


    /**
     * addActor
     *
     * Adds an actor to this movie
     *
     * @param string                          $character What Character the actor will play
     * @param \moviecollection\entities\Actor $actor
     *
     * @access public
     * @return void
     */
    public function addActor(Actor $actor, $character = "Character")
    {
        $actorBornYet = false;
        $actorDob = $actor->getDob();
        $releaseDate = $this->releaseDate;
        $interval = $this->releaseDate->diff($actorDob);
        $intervalStr = $interval->format('%R%a');
        $actorBornYet = $intervalStr <= -1;
        if ($actorBornYet) {
            $this->actors[$character] = $actor;
        } else {
            throw new \Exception("Actor Born After Movie Release");
        }
    }


    /**
     * getActors
     *
     * Gets a list of the actors in this movie
     *
     * @param bool $sortByAge Should they be reverse sorted by age
     * @access public
     * @return [\moviecollection\entities\Actor]
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
     * Comapres two Actors for thier dob
     *
     * @param \moviecollection\entities\Actors $a
     * @param \moviecollection\entities\Actors $b
     *
     * @static
     * @access public
     * @return bool
     */
    public static function compareActors($a, $b)
    {
        return $a->getDob()->diff($b->getDob())->format('%R%a') <= 0;
    }


    /**
     * generateUUID
     *
     * Generates a uuid for this actor
     *
     * @access public
     * @return String
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
     * Default Constructor
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
     * Generates a movie based on arguments
     *
     * @param DateTime $releaseDate The movie release date
     * @param string   $title       The movie title
     * @param int      $runtime     The runtime
     *
     * @static
     * @access public
     * @return /moviecollection/entities/Movie
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
     * Sets the title
     *
     * @param string $title The title to set
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
     * Sets the runtime
     *
     * @param int $runtime The runtime to set in mins
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
     * Sets the release date
     *
     * @param DateTime $releaseDate The movie's release date
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
     * Represents this object as json
     *
     * @access public
     * @return string
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
