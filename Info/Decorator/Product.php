<?php

namespace fall1600\Package\Suntech\Info\Decorator;

use fall1600\Package\Suntech\Contracts\ProductInterface;
use fall1600\Package\Suntech\Info\Info;
use fall1600\Package\Suntech\Info\InfoDecorator;

class Product extends InfoDecorator
{
    public const SIZE = 10;

    /**
     * @var Info
     */
    protected $info;

    /**
     * 僅接受接受 1 ~ 10
     * @var int
     */
    protected $index;

    /**
     * @var ProductInterface
     */
    protected $product;

    public function __construct(Info $info, int $index, ProductInterface $product)
    {
        $this->info = $info;

        $this->setIndex($index);

        $this->product = $product;
    }

    public function getInfo()
    {
        return $this->info->getInfo() +
            [
                "ProductName{$this->index}" => $this->product->getName(),
                "ProductPrice{$this->index}" => $this->product->getPrice(),
                "ProductQuantity{$this->index}" => $this->product->getQuantity(),
            ];
    }

    protected function setIndex(int $index)
    {
        if ($index < 1 || $index > static::SIZE) {
            throw new \LogicException("unsupported index: $index");
        }

        $this->index = $index;
    }
}
