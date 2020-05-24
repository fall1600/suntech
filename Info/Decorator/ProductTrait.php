<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Contracts\ProductInterface;

trait ProductTrait
{
    public $size = 10;

    /**
     * @var ProductInterface[]
     */
    protected $products = [];

    public function appendProduct(ProductInterface $product)
    {
        $this->products[]= $product;

        return $this;
    }

    public function resetProducts()
    {
        $this->products = [];

        return $this;
    }

    public function getProductInfo()
    {
        $result = [];

        /**
         * @var  int $index
         * @var  ProductInterface $product
         */
        foreach ($this->products as $index => $product) {
            $result += [
                'ProductName'.($index+1) => $product->getName(),
                'ProductPrice'.($index+1) => $product->getPrice(),
                'ProductQuantity'.($index+1) => $product->getQuantity(),
            ];
        }

        return $result;
    }
}
