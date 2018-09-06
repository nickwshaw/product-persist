<?php

namespace Willshaw\Persistence\Driver;

interface IMySQLDriver
{
    /**
     * @param string $id
     * @return array
     */
    public function findProduct($id);
}