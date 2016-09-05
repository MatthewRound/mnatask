<?php namespace moviecollection\entities;

/**
 * Holds the class moviecollection/entities/EntityInterface.php
 *
 * PHP version 5
 *
 * @category Core
 * @package  moviecollection/entities/EntityInterface.php
 * @author   Matthew Round <roundyz32@gmail.com>
 * @license  (All rights and ownership reserved)
 * @link
 *
 */

/**
 * EntityInterface
 *
 * @package   moviecollection/entities
 * @version   1.0
 * @copyright 2016
 * @author    Matthew Round <roundyz32@gmail.com>
 * @license   All rights and ownership reserved
 */
interface EntityInterface
{


    /**
     * generateUUID
     *
     * Generates a uuid
     *
     * @access public
     * @return string
     */
    public function generateUUID();
}
