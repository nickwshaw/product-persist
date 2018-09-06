<?php

namespace Willshaw\Persistence;

/**
 * Interface PersistenceInterface
 * @package Willshaw\Persistence
 */
interface PersistenceInterface {
    /**
     * @param $id
     * @return array
     */
    public function getById($id);
}