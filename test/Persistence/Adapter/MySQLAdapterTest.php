<?php

namespace Willshaw\Test\Persistence\Adapter;

use Willshaw\Persistence\Adapter\MySQLAdapter;

class MySQLAdapterTest extends \PHPUnit_Framework_TestCase
{

    private $mock_mysql_driver;
    private $mysql_adapter;
    private $mock_product;


    public function setup() {
        $this->mock_mysql_driver = $this->getMock('Willshaw\Persistence\Driver\IMySQLDriver');
        $this->mysql_adapter = new MySQLAdapter($this->mock_mysql_driver);
        $this->mock_product = $this->getMockBuilder('Willshaw\Entity\Product');
    }

    public function testApapterGetsProduct() {
        $this->mock_mysql_driver->expects($this->once())
          ->method('findProduct')->willReturn($this->mock_product);
        $this->assertSame($this->mock_product, $this->mysql_adapter->getById(5));
    }

}
