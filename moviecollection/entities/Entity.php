<?php namespace moviecollection\entities;

abstract class Entity
{

	public $uuid = '';

	private function 	__construct()
	{
		$this->uuid = 0;
	}

	public function getUUID()
	{
		if ($this->uuid == 0 ) {
			$this->uuid = $this->generateUUID();
		}
		return $this->uuid;
	}


	public function toJson()
	{
		//TODO complete this
		return json_encode($this);
	}

}
