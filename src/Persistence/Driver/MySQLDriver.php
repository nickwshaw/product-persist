<?php

namespace Willshaw\Persistence\Driver;

class MySQLDriver implements IMySQLDriver {

    /**
     * @param string $id
     * @return array
     */
    public function findProduct($id)
    {
        // Get product from DB
        return array(
          'id' => $id,
          'name' => 'Product ' . $id,
          'price' => 1.50
        );
    }

}