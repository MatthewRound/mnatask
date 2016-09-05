<?php namespace moviecollection\entities;

use \DateTime;
use moviecollection\entities\Entity;
use moviecollection\entities\EntityInterface;


class Actor extends Entity implements EntityInterface
{

    private $name;

    private $dob;

	public function 	generateUUID()
	{
		$str = $this->name . $this->dob->format('Y-M-d');
		$hash = md5($str);
		return $hash;
	}

    private function     __construct() {
        $this->name = "";
        $this->dob = new DateTime();
    }


    public function     getName()
    {
        return $this->name;
    }


    public function     getDob()
    {
        return $this->dob;
    }


    public function setName($name = "")
    {
		$nameOk = strlen($name) >= 3;
		if ($nameOk) {
			$this->name = $name;
		}
    }


    public function     setDob(\DateTime $dob)
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

    public static function generate($name, $dob){
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


	public function 	toJson()
	{
		$ob = new \StdClass();
		$ob->name = $this->name;
		$ob->dob = $this->dob->format('Y-M-d');
		return json_encode($ob);
	}
}
