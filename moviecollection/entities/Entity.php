<?php namespace moviecollection\entities;

/**
 * Entity
 *
 * @abstract
 * @uses     EntityInterface
 * @package   moviecollection/entities
 * @version   1.0
 * @copyright 2016
 * @author    Matthew Round <roundyz32@gmail.com>
 * @license   All rights and ownership reserved
 */
abstract class Entity implements EntityInterface
{


    /**
     * uuid
     *
     * This entity's uuid
     *
     * @var string
     * @access protected
     */
    protected $uuid = '';


    /**
     * __construct
     *
     * Default constructor
     *
     * @access private
     * @return void
     */
    private function __construct()
    {
        $this->uuid = 0;
    }


    /**
     * getUUID
     *
     * Generates a uuid
     *
     * @access public
     * @return String the uuid
     */
    public function getUUID() : string
    {
        if ($this->uuid == 0) {
            $this->uuid = $this->generateUUID();
        }
        return $this->uuid;
    }
}
