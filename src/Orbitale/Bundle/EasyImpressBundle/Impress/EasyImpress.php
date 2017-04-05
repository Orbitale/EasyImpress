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

class EasyImpress
{
    /**
     * @var array[]
     */
    protected $presentationsArray;

    /**
     * @var Presentation[]
     */
    protected $presentations;

    public function __construct(array $presentations)
    {
        $this->presentationsArray = $presentations;
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

        return array_key_exists($name, $presentations) ? $presentations[$name] : null;
    }

    /**
     * @return Presentation[]
     */
    private function doGetPresentations()
    {
        if (null !== $this->presentations) {
            return $this->presentations;
        }

        $this->presentations = [];

        foreach ($this->presentationsArray as $name => $presentation) {
            $this->presentations[$name] = new Presentation($presentation);
        }

        return $this->presentations;
    }
}
