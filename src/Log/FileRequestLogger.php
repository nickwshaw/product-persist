<?php
namespace Willshaw\Log;

use Willshaw\Entity\Product;

/**
 * Class FileRequestLogger
 * @package Willshaw\Log
 * Uses file locking to prevent race conditions.
 */
class FileRequestLogger
{
    /**
     * @var string File to log requests to.
     */
    private $filename;

    /**
     * FileRequestLogger constructor.
     * @param $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @param \Willshaw\Entity\Product $product
     * @throws \Exception
     */
    public function logRequest(Product $product)
    {

        $fp = fopen($this->filename, "c+");

        if(flock($fp, LOCK_EX)) {
            $store = json_decode(fread($fp, 8192), true);
            if (!$store) {
                $store = array();
            }
            $store[$product->getId()] =
              (isset($store[$product->getId()])) ? $store[$product->getId()]+1 : 1;
            ftruncate($fp, 0);
            rewind($fp);
            fwrite($fp, json_encode($store));
            flock($fp, LOCK_UN);
        } else {
            throw new \Exception('Unable to get file lock');
        }
    }

}