<?php

namespace Willshaw\Service;

use Willshaw\Entity\Product;
use Willshaw\Persistence\PersistenceInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * Class ProductService
 * @package Willshaw\Service
 */
class ProductService
{
    /**
     * @var \Willshaw\Persistence\PersistenceInterface
     */
    private $persistence;
    /**
     * @var \Psr\SimpleCache\CacheInterface
     */
    private $cache;

    /**
     * ProductService constructor.
     * @param \Willshaw\Persistence\PersistenceInterface $persistence
     * @param \Psr\SimpleCache\CacheInterface $cache
     */
    public function __construct(PersistenceInterface $persistence, CacheInterface $cache)
    {
        $this->cache = $cache;
        $this->persistence = $persistence;
    }

    /**
     * @param $id
     * @return \Willshaw\Entity\Product
     */
    public function getProductById($id)
    {
        $product = $this->cache->get($this->getCacheKey($id), false);

        if (!$product) {
            $product_data = $this->persistence->getById($id);
            $product = new Product(
              $product_data['id'],
              $product_data['name'],
              $product_data['price']
            );
            $this->cache->set($this->getCacheKey($id), $product);
        }

        return $product;
    }

    /**
     * @param $id
     * @return string
     */
    public function getCacheKey($id) {
      return 'product_' . $id;
    }

}