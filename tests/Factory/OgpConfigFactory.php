<?php
declare(strict_types=1);

namespace DubOgp\Test\Factory;

use CakephpFixtureFactories\Factory\BaseFactory as CakephpBaseFactory;
use Faker\Generator;

class OgpConfigFactory extends CakephpBaseFactory
{
    
    protected function getRootTableRegistryName(): string
    {
        return 'DubOgp.OgpConfigs';
    }
    
    protected function setDefaultTemplate(): void
    {
        $this->setDefaultData(function (Generator $faker) {
            return [
                'name' => $faker->text,
                'value' => $faker->text,
            ];
        });
    }
}

