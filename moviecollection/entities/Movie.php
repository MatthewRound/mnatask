<?php namespace moviecollection\entities;

use \DateTime;
use moviecollection\entities\Actor;
use moviecollection\entities\EntityInterface;


class Movie extends Entity implements EntityInterface
{

	protected $title;
	private $runtime;
	private $releaseDate;
	private $actors;

	public function	addActor(Actor $actor)
	{
		$actorBornYet = false;
		$actorDob = $actor->getDob();
		$releaseDate = $this->releaseDate;
		$interval = $this->releaseDate->diff($actorDob);
		$intervalStr = $interval->format('%R%a');
		$actorBornYet = $intervalStr <= -1;
		if ($actorBornYet) {
			$this->actors[] = $actor;
		} else {
			throw new \Exception("Actor Born After Movie Release");
		}
	}


	public function	getActors($sortByAge = false)
	{
		if ($sortByAge) {
			sort($this->actors, 'moviecollection\entities\Movie::CompareActors');
		}
		return $this->actors;
	}


	public static function CompareActors($a, $b)
	{
		return $a->getDob()->diff($b->getDob())->format('%R%a') >= 0;
	}


	public function     generateUUID()
	{
		$str = $this->title . $this->releaseDate->format("Y-m-d") . $this->runtime;
		$hash = md5($str);
		return $hash;
	}


	private function     __construct() {
		$this->title = "";
		$this->runtime = 60;
		$this->releaseDate = new DateTime();
		$this->actors = [];
	}

	public static function generate($title = '', $runtime = 60, DateTime $releaseDate)
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


	public function 	setTitle($title = "")
	{
		$len = strlen($title);
		$tooShort = $len <= 3;
		$tooLong = $len >= 200;
		$titleLengthOk =  !$tooLong && !$tooShort;
		if($titleLengthOk) {
			$this->title = $title;
		} else {
			throw new \Exception("Title length invalid");
		}
	}


	public function 	setRuntime($runtime = 60)
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


	public function 	setReleaseDate(DateTime $releaseDate)
	{
		$this->releaseDate = $releaseDate;
	}

	public function toJson()
	{
		//TODO complete this
		return json_encode($this);
	}

}
