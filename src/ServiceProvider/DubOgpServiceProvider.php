<?php
declare(strict_types=1);
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.7
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace DubOgp\ServiceProvider;

use DubOgp\Service\DubOgpConfigsService;
use DubOgp\Service\DubOgpConfigsServiceInterface;
use DubOgp\Service\Admin\DubOgpConfigsAdminService;
use DubOgp\Service\Admin\DubOgpConfigsAdminServiceInterface;
use Cake\Core\ServiceProvider;

/**
 * DubOgp Service Provider
 */
class DubOgpServiceProvider extends ServiceProvider
{

    /**
     * Provides
     * @var string[]
     */
    protected $provides = [
        // TableNameAdminServiceInterface::class,
        DubOgpConfigsServiceInterface::class,
        DubOgpConfigsAdminServiceInterface::class,
    ];

    /**
     * Services
     * @param \Cake\Core\ContainerInterface $container
     */
    public function services($container): void
    {
        $container->defaultToShared(true);
        //$container->add(TableNameAdminServiceInterface::class, TableNameAdminService::class);
        $container->add(DubOgpConfigsServiceInterface::class, DubOgpConfigsService::class);
        $container->add(DubOgpConfigsAdminServiceInterface::class, DubOgpConfigsAdminService::class);
    }

}