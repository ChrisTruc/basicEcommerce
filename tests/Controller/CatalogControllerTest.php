<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CatalogControllerTest extends WebTestCase
{
    public function testHomepageOK()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testNumberProductOK()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $nbDivProduct = $crawler->filter('div[id^="product-"]')->count();

        $this->assertNotSame(11, $nbDivProduct);
        $this->assertSame(12, $nbDivProduct);
    }
}
?>