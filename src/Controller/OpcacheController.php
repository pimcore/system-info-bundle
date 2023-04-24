<?php
declare(strict_types=1);

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace Pimcore\Bundle\SystemInfoBundle\Controller;

use Pimcore\Controller\KernelControllerEventInterface;
use Pimcore\Controller\UserAwareController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Profiler\Profiler;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/opcache")
 *
 * @internal
 */
class OpcacheController extends UserAwareController implements KernelControllerEventInterface
{
    /**
     * @Route("/index", name="pimcore_bundle_systeminfo_opcache_index")
     *
     * @param Request $request
     * @param Profiler|null $profiler
     *
     * @return Response
     */
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
