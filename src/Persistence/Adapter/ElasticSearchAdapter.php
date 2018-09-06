<?php

namespace Willshaw\Persistence\Adapter;

use Willshaw\Persistence\PersistenceInterface;
use Willshaw\Persistence\Driver\IElasticSearchDriver;

/**
 * Class ElasticSearchAdapter
 * @package Willshaw\Persistence\Adapter
 * Adapter to provide a common interface for storage back ends.
 */
class ElasticSearchAdapter implements PersistenceInterface {

    /**
     * @var \Willshaw\Persistence\Driver\IElasticSearchDriver
     */
    private $driver;

    /**
     * ElasticSearchAdapter constructor.
     * @param \Willshaw\Persistence\Driver\IElasticSearchDriver $driver
     */
    public function __construct(IElasticSearchDriver $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @param $id
     * @return array
     */
    public function getById($id)
    {
        return $this->driver->findById($id);
    }
}