<?php
namespace Willshaw\Persistence\Adapter;

use Willshaw\Persistence\PersistenceInterface;
use Willshaw\Persistence\Driver\IMySQLDriver;

/**
 * Class MySQLAdapter
 * @package Willshaw\Persistence\Adapter
 * Adapter to provide a common interface for storage back ends.
 */
class MySQLAdapter implements PersistenceInterface
{
    /**
     * @var \Willshaw\Persistence\Driver\IMySQLDriver
     */
    private $driver;

    /**
     * MySQLAdapter constructor.
     * @param \Willshaw\Persistence\Driver\IMySQLDriver $driver
     */
    public function __construct(IMySQLDriver $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @param $id
     * @return array
     */
    public function getById($id) {
        return $this->driver->findProduct($id);
    }
}