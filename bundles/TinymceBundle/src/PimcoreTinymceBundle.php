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

namespace Pimcore\Bundle\TinymceBundle;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Pimcore\Extension\Bundle\PimcoreBundleAdminClassicInterface;
use Pimcore\Extension\Bundle\Traits\BundleAdminClassicTrait;
use Pimcore\Extension\Bundle\Traits\PackageVersionTrait;
use Pimcore\Helper\EncoreHelper;

class PimcoreTinymceBundle extends AbstractPimcoreBundle implements PimcoreBundleAdminClassicInterface
{
    use BundleAdminClassicTrait;
    use PackageVersionTrait;

    public function getCssPaths(): array
    {
        trigger_deprecation(
            'pimcore/pimcore',
            '11.5.0',
            'TinyMCE is deprecated, please use Quill (pimcore/quill-bundle) instead'
        );

        return [
            '/bundles/pimcoretinymce/css/editor.css',
        ];
    }

    public function getEditmodeCssPaths(): array
    {
        return [
            '/bundles/pimcoretinymce/css/editor.css',
        ];
    }

    public function getJsPaths(): array
    {
        return $this->getAllJsPaths();
    }

    public function getEditmodeJsPaths(): array
    {
        return $this->getAllJsPaths();
    }

    public function getInstaller(): Installer
    {
        return $this->container->get(Installer::class);
    }

    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    private function getAllJsPaths(): array
    {
        $paths = EncoreHelper::getBuildPathsFromEntrypoints($this->getPath() . '/public/build/tinymce/entrypoints.json');
        $paths[]= '/bundles/pimcoretinymce/js/editor.js';

        return $paths;
    }
}
