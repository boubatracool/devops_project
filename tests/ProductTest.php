<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Product;

class ProductTest extends TestCase
{
    /**
     * @dataProvider priceList
     */
    public function testPrice($price, $testPrice): void
    {
        $product = new Product();
        $product->setName('Samsung Galaxy A54');
        $product->setPrice($price);
        $product->setImage('galaxy_a54.jpg');
        $product->setDescription('DD 128Go, RAM 6Go, Couleur Bleue');
        $this->assertSame(strval($testPrice), $product->getPrice());
    }

    public function priceList()
    {
        return [
            [150000, 150000],
            [175000, 175000],
            [200000, 200000],
        ];
    }
}
