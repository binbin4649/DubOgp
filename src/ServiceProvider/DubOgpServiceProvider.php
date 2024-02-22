<?php

namespace DubOgp\ServiceProvider;

use DubOgp\Service\OgpConfigsService;
use DubOgp\Service\OgpConfigsServiceInterface;
use Cake\Core\ServiceProvider;

class DubOgpServiceProvider extends ServiceProvider
{
    protected $provides = [
        OgpConfigsServiceInterface::class,
    ];

    public function services($container): void
    {
        $container->defaultToShared(true);
        $container->add(OgpConfigsServiceInterface::class, OgpConfigsService::class);
        
    }

}



