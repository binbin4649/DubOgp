<?php
//php vendor/bin/phpunit --filter OgpConfigsServiceTest plugins/DubOgp/tests/

namespace DubOgp\Test\TestCase\Service;

use DubOgp\Test\Factory\OgpConfigFactory;
use BaserCore\TestSuite\BcTestCase;
use DubOgp\Service\OgpConfigsService;
use DubOgp\Service\OgpConfigsServiceInterface;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;
use Error;

class OgpConfigsServiceTest extends BcTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->OgpConfigsService = $this->getService(OgpConfigsServiceInterface::class);
        //$this->OgpConfigsService = $this->get(OgpConfigsServiceInterface::class);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->OgpConfigsService);
    }

    public function test__construct()
    {
        $factory = new \DubOgp\Test\Factory\OgpConfigFactory();
        var_dump($factory);
        die;

        OgpConfigFactory::make(5)->persist();
        $r = $this->OgpConfigsService->OgpConfigs->getTable();
        var_dump($r);
        die;
        $this->assertEquals('mail_contents', $r);
    }

}