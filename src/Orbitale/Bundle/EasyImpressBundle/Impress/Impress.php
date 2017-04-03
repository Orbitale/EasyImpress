<?php

/**
 * This file is part of the EasyImpress package.
 *
 * (c) Alexandre Rock Ancelet <alex@orbitale.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Orbitale\Bundle\EasyImpressBundle\Impress;

use Orbitale\Bundle\EasyImpressBundle\Model\Presentation;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Finder\Finder;

class Impress
{
    /**
     * @var Presentation[]
     */
    protected $presentations;

    /**
     * @var AdapterInterface
     */
    protected $cacheAdapter;

    /**
     * @var ConfigProcessor
     */
    protected $configProcessor;

    /**
     * @var string
     */
    protected $presentationsDir;

    public function __construct(AdapterInterface $cacheAdapter, ConfigProcessor $configProcessor, $presentationsDir)
    {
        $this->cacheAdapter     = $cacheAdapter;
        $this->configProcessor = $configProcessor;
        $this->presentationsDir = $presentationsDir;
    }

    /**
     * @param string $name
     *
     * @return Presentation
     */
    public function getPresentation($name)
    {
        return $this->doGetPresentation($name);
    }

    /**
     * @return Presentation[]
     */
    public function getAllPresentations()
    {
        return $this->doGetPresentations();
    }

    /**
     * @param string $name
     *
     * @return null|Presentation
     */
    private function doGetPresentation($name)
    {
        // Get all presentations first
        $presentations = $this->getAllPresentations();

        if (!array_key_exists($name, $presentations)) {
            return null;
        }

        return $presentations[$name];
    }

    /**
     * @return Presentation[]
     */
    private function doGetPresentations()
    {
        $finder = (new Finder())
            ->files()
            ->name('*.yml')
            ->in($this->presentationsDir)
        ;

        $presentations = [];

        foreach ($finder as $file) {
            $presentations[basename($file, '.yml')] = $this->configProcessor->processConfigurationFile($file);
        }

        return $presentations;
    }
}
