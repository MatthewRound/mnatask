<?php namespace moviecollection\entities;

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
    public function generateUUID() : string;
}
