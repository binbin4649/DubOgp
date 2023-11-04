<?php

namespace DubOgp\Test\Scenario;

use BaserCore\Test\Factory\ContentFactory;
use DubOgp\Test\Factory\OgpConfigFactory;
use CakephpFixtureFactories\Scenario\FixtureScenarioInterface;

class OgpConfigScenario implements FixtureScenarioInterface
{
    public function load(...$args)
    {
        OgpConfigFactory::make([
            'id' => 1,
            'name' => 'twitter_id',
            'value' => '123456789',
        ])->persist();
        OgpConfigFactory::make([
            'id' => 2,
            'name' => 'twitter_card',
            'value' => 'sdrtyui',
        ])->persist();
        OgpConfigFactory::make([
            'id' => 3,
            'name' => 'fb_app_id',
            'value' => 'ertyukk',
        ])->persist();
        OgpConfigFactory::make([
            'id' => 4,
            'name' => 'default_image',
            'value' => 'logo_png',
        ])->persist();
        OgpConfigFactory::make([
            'id' => 5,
            'name' => 'locale',
            'value' => 'ja_jp',
        ])->persist();
        OgpConfigFactory::make([
            'id' => 6,
            'name' => 'locale_alternate',
            'value' => 'us_en',
        ])->persist();

    }
}