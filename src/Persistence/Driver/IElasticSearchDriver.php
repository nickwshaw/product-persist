<?php

namespace Willshaw\Persistence\Driver;

interface IElasticSearchDriver
{
    /**
     * @param string $id
     * @return array
     */
    public function findById($id);
}