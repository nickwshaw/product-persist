<?php

namespace Willshaw\Test\Persistence\Adapter;

use Willshaw\Persistence\Adapter\ElasticSearchAdapter;

class ElasticSearchDriverTest extends \PHPUnit_Framework_TestCase
{

    private $mock_elastic_driver;
    private $elastic_adapter;
    private $mock_product;


    public function setup() {
        $this->mock_elastic_driver = $this->getMock('Willshaw\Persistence\Driver\IElasticSearchDriver');
        $this->elastic_adapter = new ElasticSearchAdapter($this->mock_elastic_driver);
        $this->elastic_product = $this->getMockBuilder('Willshaw\Entity\Product');
    }

    public function testApapterGetsProduct() {
        $this->mock_elastic_driver->expects($this->once())
          ->method('findById')->willReturn($this->mock_product);
        $this->assertSame($this->mock_product, $this->elastic_adapter->getById(5));
    }

}