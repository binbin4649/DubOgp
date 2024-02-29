<?php
//php vendor/bin/phpunit --filter OgpConfigsTableTest plugins/DubOgp/tests/

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use DubOgp\Model\Table\OgpConfigsTable;
use DubOgp\Test\Factory\OgpConfigFactory;

class OgpConfigsTableTest extends TestCase
{
    /**
     * @var OgpConfigsTable
     */
    public $OgpConfigs;

    public function setUp(): void
    {
        parent::setUp();
        $this->OgpConfigs = TableRegistry::getTableLocator()->get('OgpConfigs', ['className' => OgpConfigsTable::class]);
        OgpConfigFactory::make()->persist();
    }

    public function tearDown(): void
    {
        unset($this->OgpConfigs);

        parent::tearDown();
    }

    public function testValidationDefault()
    {
        $data = [
            'name' => '',
            'value' => 'テスト値'
        ];
        $ogpConfig = $this->OgpConfigs->newEntity($data);
        $this->assertFalse($ogpConfig->hasErrors());

        $data = [
            'name' => str_repeat('a', 256), // 256文字を超える
            'value' => 'テスト値'
        ];
        $ogpConfig = $this->OgpConfigs->newEntity($data);
        $this->assertTrue($ogpConfig->hasErrors());
    }

    public function testValidationKeyValue()
    {
        $data = [
            'site_name' => ''
        ];
        $ogpConfig = $this->OgpConfigs->newEntity($data, ['validate' => 'keyValue']);
        $this->assertTrue($ogpConfig->hasErrors());

        $data = [
            'site_name' => 'テストサイト'
        ];
        $ogpConfig = $this->OgpConfigs->newEntity($data, ['validate' => 'keyValue']);
        $this->assertFalse($ogpConfig->hasErrors());
    }
}
