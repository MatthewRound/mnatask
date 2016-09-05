<?php namespace moviecollection\entities;

/**
 * Holds the class moviecollection/entities/Entity.php
 *
 * PHP version 5
 *
 * @category Core
 * @package  moviecollection/entities/Entity.php
 * @author   Matthew Round <roundyz32@gmail.com>
 * @license  (All rights and ownership reserved)
 * @link
 *
 */


/**
 * Entity
 *
 * @abstract
 * @package   moviecollection/entities
 * @version   1.0
 * @copyright 2016
 * @author    Matthew Round <roundyz32@gmail.com>
 * @license   All rights and ownership reserved
 */
abstract class Entity
{

    /**
     * uuid
     *
     * @var string
     * @access protected
     */
    protected $uuid = '';


    /**
     * __construct
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
     * @access public
     * @return void
     */
    public function getUUID()
    {
        if ($this->uuid == 0) {
            $this->uuid = $this->generateUUID();
        }
        return $this->uuid;
    }
}
