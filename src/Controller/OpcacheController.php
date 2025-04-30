<?php
declare(strict_types=1);

/**
 * This source file is available under the terms of the
 * Pimcore Open Core License (POCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (https://www.pimcore.com)
 *  @license    Pimcore Open Core License (POCL)
 */

namespace Pimcore\Bundle\SystemInfoBundle\Controller;

use Pimcore\Controller\KernelControllerEventInterface;
use Pimcore\Controller\UserAwareController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Profiler\Profiler;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @internal
 */
#[Route('/opcache')]
class OpcacheController extends UserAwareController implements KernelControllerEventInterface
{
    /**
     * @param Request $request
     * @param Profiler|null $profiler
     *
     * @return Response
     */
    #[Route('/index', name: 'pimcore_bundle_systeminfo_opcache_index')]
    public function indexAction(Request $request, ?Profiler $profiler): Response
    {
        if ($profiler) {
            $profiler->disable();
        }

        $path = PIMCORE_COMPOSER_PATH . '/amnuts/opcache-gui';

        ob_start();
        include($path . '/index.php');
        $content = ob_get_clean();

        return new Response($content);
    }

    public function onKernelControllerEvent(ControllerEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        // only for admins
        $this->checkPermission('opcache');
    }
}
