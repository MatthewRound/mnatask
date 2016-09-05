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

	public function 	addActor(Actor $actor)
	{
		//TODO validation for actors age  vs film age
		$this->actors[] = $actor;
	}

	public function 	getActors($sortByAge = false)
	{
		if ($sortByAge) {
			//TODO sort by age
		} else {
			return $this->actors;
		}
	}


	public function     generateUUID()
	{
		return "";
		//TODO generate this
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
		//TODO validation
		$this->title = $title;
	}


	public function 	setRuntime($runtime = 60)
	{
		//TODO validation
		$this->runtime = $runtime;
	}


	public function 	setReleaseDate(DateTime $releaseDate)
	{
		//TODO validation
		$this->releaseDate = $releaseDate;
	}


}
