<?php

namespace Willshaw\Entity;

class Product
{
    /**
     * @var $id int
     */
    private $id;
    /**
     * @var $name string
     */
    private $name;
    /**
     * @var float
     */
    private $price;

    /**
     * Product constructor.
     * @param $id int
     * @param $name string
     * @param $price float
     */
    public function __construct($id, $name, $price) {
        // Validate data
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice() {
        return $this->price;
    }
}