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

class SlideReset
{
    /**
     * @var bool
     */
    protected $x;

    /**
     * @var bool
     */
    protected $y;

    /**
     * @var bool
     */
    protected $z;

    /**
     * @var bool
     */
    protected $rotateX;

    /**
     * @var bool
     */
    protected $rotateY;

    /**
     * @var bool
     */
    protected $rotateZ;

    public function __construct(array $config)
    {
        $this->x = (bool) $config['x'];
        $this->y = (bool) $config['y'];
        $this->z = (bool) $config['z'];
        $this->rotateX = (bool) $config['rotate-x'];
        $this->rotateY = (bool) $config['rotate-y'];
        $this->rotateZ = (bool) ($config['rotate-z'] ?: $config['rotate']); // "rotate" and "rotate-z" are aliases
    }

    /**
     * @return bool
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return bool
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @return bool
     */
    public function getZ()
    {
        return $this->z;
    }

    /**
     * @return bool
     */
    public function getRotateX()
    {
        return $this->rotateX;
    }

    /**
     * @return bool
     */
    public function getRotateY()
    {
        return $this->rotateY;
    }

    /**
     * @return bool
     */
    public function getRotateZ()
    {
        return $this->rotateZ;
    }

    /**
     * @return int
     */
    public function getRotate()
    {
        return $this->getRotateZ();
    }
}
