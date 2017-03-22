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

class SlideData implements \IteratorAggregate
{
    /**
     * @var int
     */
    protected $x;

    /**
     * @var int
     */
    protected $y;

    /**
     * @var int
     */
    protected $z;

    /**
     * @var int
     */
    protected $rotateX;

    /**
     * @var int
     */
    protected $rotateY;

    /**
     * @var int
     */
    protected $rotateZ;

    public function __construct(array $config)
    {
        $this->x       = (int) $config['x'] ?: null;
        $this->y       = (int) $config['y'] ?: null;
        $this->z       = (int) $config['z'] ?: null;
        $this->rotateX = (int) $config['rotate-x'] ?: null;
        $this->rotateY = (int) $config['rotate-y'] ?: null;
        $this->rotateZ = (int) ($config['rotate-z'] ?: $config['rotate']) ?: null; // "rotate" and "rotate-z" are aliases
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @return int
     */
    public function getZ()
    {
        return $this->z;
    }

    /**
     * @return int
     */
    public function getRotateX()
    {
        return $this->rotateX;
    }

    /**
     * @return int
     */
    public function getRotateY()
    {
        return $this->rotateY;
    }

    /**
     * @return int
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

    public function getIterator()
    {
        return new \ArrayIterator([
            'x'        => $this->x,
            'y'        => $this->y,
            'z'        => $this->z,
            'rotate-x' => $this->rotateX,
            'rotate-y' => $this->rotateY,
            'rotate-z' => $this->rotateZ,
        ]);
    }
}
