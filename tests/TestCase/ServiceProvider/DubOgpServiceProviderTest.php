<?php

namespace DubOgp\Test\TestCase\ServiceProvider;

use Cake\TestSuite\TestCase;
use DubOgp\Service\DubOgpConfigsServiceInterface;
use DubOgp\ServiceProvider\DubOgpServiceProvider;
use Cake\Core\Container;

class DubOgpServiceProviderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->DubOgpServiceProvider = new DubOgpServiceProvider();
    }

    public function tearDown(): void
    {
        unset($this->DubOgpServiceProvider);
        parent::tearDown();
    }

    public function testServices()
    {
        $container = new Container();
        $this->DubOgpServiceProvider->services($container);
        $this->assertTrue($container->has(DubOgpConfigsServiceInterface::class));
    }


}