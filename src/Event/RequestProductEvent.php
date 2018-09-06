<?php
namespace Willshaw\Event;

use Symfony\Component\EventDispatcher\Event;
use Willshaw\Entity\Product;

class RequestProductEvent extends Event
{

    const NAME = 'product.requested';

    /**
     * @var \Willshaw\Entity\Product
     */
    private $product;

    /**
     * RequestProductEvent constructor.
     * @param \Willshaw\Entity\Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return \Willshaw\Entity\Product
     */
    public function getProduct() {
        return $this->product;
    }

}