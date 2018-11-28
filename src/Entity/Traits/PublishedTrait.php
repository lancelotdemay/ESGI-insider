<?php
/**
 * Created by PhpStorm.
 * User: lens
 * Date: 28/11/2018
 * Time: 14:59
 */

namespace App\Entity\Traits;


trait PublishedTrait
{
    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default": true})
     */
    private $published = true;

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     *
     * @return PublishedTrait
     */
    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }
}