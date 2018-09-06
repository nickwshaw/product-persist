<?php
require_once('vendor/autoload.php');
use Willshaw\Controller\ProductController;
use Willshaw\Event\RequestProductListener;
use Acclimate\Container\ContainerAcclimator;
use Pimple\Container;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\Yaml\Yaml;
use Willshaw\Persistence\Adapter\MySQLAdapter;
use Willshaw\Persistence\Adapter\ElasticSearchAdapter;
use Willshaw\Persistence\Driver\MySQLDriver;
use Willshaw\Persistence\Driver\ElasticSearchDriver;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\EventDispatcher\EventDispatcher;


$config = Yaml::parse(file_get_contents(__DIR__ . '/config/config.yaml'));
$base_path = __DIR__;


$pimple = new Container($config);
$pimple['base_path'] = $base_path;
$pimple['persistence'] = function($c) {
    if ($c['persistence_driver'] === 'mysql') {
        return new MySQLAdapter(new MySQLDriver());
    }
    return new ElasticSearchAdapter(new ElasticSearchDriver());
};
$pimple['cache'] = function($c) {
    return new FilesystemCache();
};
$pimple['product_service'] = function($c) {
    return new \Willshaw\Service\ProductService($c['persistence'], $c['cache']);
};
$pimple['serializer'] = function($c) {
    $encoders = array(new JsonEncoder());
    $normalizers = array(new ObjectNormalizer());
    return new Serializer($normalizers, $encoders);
};
$pimple['event_dispatcher'] = function($c) {
    $dispatcher = new EventDispatcher();
    $dispatcher->addListener('product.requested', array(
      new RequestProductListener(new \Willshaw\Log\FileRequestLogger($c['base_path'] . '/' . $c['request_log'])), 'onProductRequest'
    ));
    return $dispatcher;
};

$acclimator = new ContainerAcclimator;
$container = $acclimator->acclimate($pimple);




$controller = new ProductController($container);
echo $controller->detail(9);




