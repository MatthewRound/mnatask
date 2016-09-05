<?php namespace moviecollection\entities;

abstract class Entity
{

	protected $uuid = '';

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


}
