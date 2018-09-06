<?php

namespace Willshaw\Test\Log;

use Willshaw\Entity\Product;
use Willshaw\Log\FileRequestLogger;

class FileRequestLoggerTest extends \PHPUnit_Framework_TestCase
{
    private $filename = 'log/test_request_log.json';
    /**
     * @var FileRequestLogger
     */
    private $request_logger;

    public function setup()
    {
        $this->filename = dirname(dirname(__DIR__)) . '/' . $this->filename;
        $this->request_logger = new FileRequestLogger($this->filename);
        if (file_exists($this->filename)) {
            unlink($this->filename);
        }
    }

    public function testLogsToFile() {
        $this->request_logger->logRequest(new Product(5, 'product', 1.50));
        $this->request_logger->logRequest(new Product(5, 'product', 1.50));
        $this->request_logger->logRequest(new Product(2, 'product', 1.50));
        $result = json_decode(file_get_contents($this->filename), true);
        $this->assertTrue($result[5] == 2);
        $this->assertTrue($result[2] == 1);
    }



}
