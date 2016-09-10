<?php namespace moviecollection\entities;

use \DateTime;
use \JsonSerializable;
use moviecollection\entities\{Actor,EntityInterface};

/**
 * Movie
 *
 * @uses      Entity
 * @uses      EntityInterface
 * @uses      JsonSerializable
 * @package   moviecollection\entities
 * @version   1.0
 * @copyright 2016
 * @author    Matthew Round <roundyz32@gmail.com>
 * @license   All rights and ownership reserved
 */
class Movie extends Entity implements EntityInterface, JsonSerializable
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

        if ($actor->isBornBefore($this->releaseDate)) {
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
    public function getActors($sortByAge = false) : array
    {
        if ($sortByAge) {
            $c = function ($a, $b) {
                return $a == $b;
            };
            usort($this->actors, $c);
        }
        return $this->actors;
    }


    /**
     * generateUUID
     *
     * Generates a uuid for this actor
     *
     * @access public
     * @return String
     */
    public function generateUUID() : string
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
    public function __construct()
    {
        $this->title = "";
        $this->runtime = 60;
        $this->releaseDate = new DateTime();
        $this->actors = [];
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
    public function setTitle($title = "A Generic Title")
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
        if ($this->validateRunTime($runtime)) {
            $this->runtime = $runtime;
        } else {
            throw new \Exception("Runtime length invalid");
        }
    }


    /**
     * validateRunTime
     *
     * Validates a movie's runtime
     *
     * @param mixed $runtime
     * @access public
     * @return void
     */
    public function validateRunTime($runtime)
    {
        $tooShort = $runtime <= 1;
        $tooLong = $runtime >= 400;
        return !$tooLong && !$tooShort;
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
        $ob->title = $this->title;
        $ob->runtime = $this->runtime;
        $ob->releaseDate = $this->releaseDate->format('Y-M-d');
        $ob->actors = [];
        foreach ($this->actors as $role => $actor) {
            $ob->actors[$role] = json_encode($actor);
        }
        return $ob;
    }
}
