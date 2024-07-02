<?php

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use runetid\sdk\Client;
use runetid\sdk\facade\Event;
use runetid\sdk\facade\Order;
use runetid\sdk\facade\Product;
use runetid\sdk\facade\User;

final class ClientTest extends TestCase
{
    public function testRequestWithoutPayload()
    {
        // Arrange
        $client = new Client($_ENV['RUNETID_API_KEY'], $_ENV['RUNETID_API_SECRET']);
        $url = '/user/list?limit=1&offset=0';
        $method = 'GET';

        // Act
        $response = $client->request($url, $method);

        // Assert
        $this->assertInstanceOf(ResponseInterface::class, $response);
        // Add more assertions as needed
    }

    public function testRequestWithAuthorizationHeader()
    {
        // Arrange
        $client = new Client($_ENV['RUNETID_API_KEY'], $_ENV['RUNETID_API_SECRET']);
        $client->bearer = 'token';
        $url = '/user/list?limit=1&offset=0';
        $method = 'GET';

        // Act
        $response = $client->request($url, $method);

        // Assert
        $this->assertInstanceOf(ResponseInterface::class, $response);
        // Add more assertions as needed
    }

    public function testGetHash()
    {
        $client = new Client('apiKey', 'apiSecret', 1234567890);
        $method = self::getMethod('getHash', $client);
        $this->assertEquals('a731d84f5b7e7e9395a0e043f183450c', $method->invoke($client));
    }

    protected static function getMethod($name, $object)
    {
        $class = new ReflectionClass($object);
        $method = $class->getMethod($name);
        // $method->setAccessible(true); // Use this if you are running PHP older than 8.1.0
        return $method;
    }

    public function testGetHashWithDifferentTime()
    {
        $client = new Client('apiKey', 'apiSecret', 9876543210);
        $method = self::getMethod('getHash', $client);
        $this->assertEquals('85c51c140d522169ead6ea76bacaef22', $method->invoke($client));
    }

    public function testGetHashWithDifferentApiKey()
    {
        $client = new Client('differentApiKey', 'apiSecret', 1234567890);
        $method = self::getMethod('getHash', $client);
        $this->assertNotEquals('012345677acf10f216b47914579569c7', $method->invoke($client));
    }

    public function testGetHashWithDifferentApiSecret()
    {
        $client = new Client('apiKey', 'differentApiSecret', 1234567890);
        $method = self::getMethod('getHash', $client);
        $this->assertNotEquals('012345677acf10f216b47914579569c7', $method->invoke($client));
    }

    public function testEventReturnsEventInstance()
    {
        $client = new Client('apiKey', 'apiSecret');
        $this->assertInstanceOf(Event::class, $client->event());
    }

    public function testUserReturnsUserInstance()
    {
        $client = new Client('apiKey', 'apiSecret');
        $this->assertInstanceOf(User::class, $client->user());
    }

    public function testOrderReturnsOrderInstance()
    {
        $client = new Client('apiKey', 'apiSecret');
        $this->assertInstanceOf(Order::class, $client->order());
    }

    public function testProductReturnsProductInstance()
    {
        $client = new Client('apiKey', 'apiSecret');
        $this->assertInstanceOf(Product::class, $client->product());
    }
}
