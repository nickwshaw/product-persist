<?php
namespace Willshaw\Controller;

use Interop\Container\ContainerInterface;
use Willshaw\Event\RequestProductEvent;

class ProductController
{
    /**
     * @var \Interop\Container\ContainerInterface
     */
    private $container;

    /**
     * ProductController constructor.
     * @param \Interop\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $id
     * @return string
     */
    public function detail($id)
    {
        $product = $this->container->get('product_service')->getProductById($id);
        $event = new RequestProductEvent($product);
        $this->container->get('event_dispatcher')->dispatch(RequestProductEvent::NAME, $event);
        return $this->container->get('serializer')->serialize($product, 'json');
    }
}
