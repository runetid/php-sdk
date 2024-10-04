<?php

use PHPUnit\Framework\TestCase;
use runetid\sdk\Client;
use runetid\sdk\models\Product as ProductModel;

class ProductTest extends TestCase
{
    public function testByIdThrowsExceptionWhenApiRequestFails()
    {
        $client = new Client('', '');

        $response = $client->product()->byId(8);
        $this->assertInstanceOf(ProductModel::class, $response);
    }
}