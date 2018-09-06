<?php
namespace Willshaw\Test\Service;

use Willshaw\Service\ProductService;

class ProductServiceTest extends \PHPUnit_Framework_TestCase
{

    private $product_service;
    private $mock_persistence;
    private $mock_cache;
    private $mock_product_entity;
    private $mock_product_data;

    public function setup()
    {
        $this->mock_persistence = $this->getMock('Willshaw\Persistence\PersistenceInterface');
        $this->mock_cache = $this->getMock('Psr\SimpleCache\CacheInterface');
        $this->product_service = new ProductService($this->mock_persistence, $this->mock_cache);
        $this->mock_product_data = array(
          'id' => 4,
          'name' => 'A product',
          'price' => 1.50
        );
        $this->mock_product_entity = $this->getMockBuilder('Willshaw\Entity\Product');
        //$this->assertInstanceOf('Willshaw\Service\ProductService', $this->product_service);
    }


    public function testGetProductById()
    {
        $this->mock_persistence->expects($this->once())
            ->method('getById')->willReturn($this->mock_product_data);
        $this->assertInstanceOf('Willshaw\Entity\Product', $this->product_service->getProductById(4));
    }

    public function testGetProductByIdFromCache()
    {
        $this->mock_cache->expects($this->once())
            ->method('get')->willReturn($this->mock_product_entity);
        $this->assertSame($this->mock_product_entity, $this->product_service->getProductById(4));
    }



}