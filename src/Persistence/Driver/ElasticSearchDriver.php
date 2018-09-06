<?php

namespace Willshaw\Persistence\Driver;

class ElasticSearchDriver implements IElasticSearchDriver
{
    /**
     * @param string $id
     * @return array
     */
    public function findById($id)
    {
        // Get product from ElasticSearch.
        return array(
          'id' => $id,
          'name' => 'Product ' . $id,
          'price' => 1.50
        );
    }
}