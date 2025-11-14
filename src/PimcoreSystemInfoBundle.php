<?php

/**
 * This source file is available under the terms of the
 * Pimcore Open Core License (POCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (https://www.pimcore.com)
 *  @license    Pimcore Open Core License (POCL)
 */

namespace Pimcore\Bundle\SystemInfoBundle;

use Pimcore\Bundle\SystemInfoBundle\DependencyInjection\PimcoreSystemInfoExtension;
use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Pimcore\Extension\Bundle\PimcoreBundleAdminClassicInterface;
use Pimcore\Extension\Bundle\Traits\BundleAdminClassicTrait;
use Pimcore\Extension\Bundle\Traits\PackageVersionTrait;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

/**
 * @deprecated version 2.2
 */
class PimcoreSystemInfoBundle extends AbstractPimcoreBundle implements PimcoreBundleAdminClassicInterface
{
    use PackageVersionTrait;
    use BundleAdminClassicTrait;

    public function __construct()
    {
        trigger_deprecation(
            'pimcore/system-info-bundle',
            '2.2',
            'The SystemInfoBundle is deprecated and will be discontinued with Pimcore Studio.'
        );
    }

    public function getContainerExtension(): ExtensionInterface
    {
        return new PimcoreSystemInfoExtension();
    }

    public function getComposerPackageName(): string
    {
        return 'pimcore/system-info-bundle';
    }

    public function getCssPaths(): array
    {
        return [
            '/bundles/pimcoresysteminfo/css/icons.css',
        ];
    }

    public function getJsPaths(): array
    {
        return [
            '/bundles/pimcoresysteminfo/js/startup.js',
        ];
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
