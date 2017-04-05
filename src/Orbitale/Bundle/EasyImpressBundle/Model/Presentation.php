<?php

/**
 * This file is part of the EasyImpress package.
 *
 * (c) Alexandre Rock Ancelet <alex@orbitale.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Orbitale\Bundle\EasyImpressBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

class Presentation
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $inactiveOpacity;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $attr;

    /**
     * @var Slide[]|ArrayCollection
     */
    protected $slides;

    /**
     * @var SlideData
     */
    protected $increments;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->inactiveOpacity = $config['inactive_opacity'];
        $this->attr = $config['attr'];
        $this->data = $config['data'];
        $this->name = $config['name'];

        $this->slides = new ArrayCollection();
        $this->increments = new SlideData($config['increments']);

        foreach ($config['slides'] as $slideArray) {
            $slide = new Slide($slideArray, $this);
            $this->slides->add($slide);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getInactiveOpacity()
    {
        return $this->inactiveOpacity;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getAttr()
    {
        return $this->attr;
    }

    /**
     * @return ArrayCollection|Slide[]
     */
    public function getSlides()
    {
        return $this->slides;
    }

    /**
     * @return SlideData
     */
    public function getIncrements()
    {
        return $this->increments;
    }
}
