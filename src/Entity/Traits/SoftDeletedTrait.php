<?php
/**
 * Created by PhpStorm.
 * User: lens
 * Date: 28/11/2018
 * Time: 14:59
 */

namespace App\Entity\Traits;


trait SoftDeletedTrait
{
    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default": true})
     */
    private $soft_deleted = true;

    /**
     * @return bool
     */
    public function isSoftDeleted(): bool
    {
        return $this->soft_deleted;
    }

    /**
     * @param bool $soft_deleted
     *
     * @return SoftDeletedTrait
     */
    public function setSoftDeleted(bool $soft_deleted): self
    {
        $this->soft_deleted = $soft_deleted;

        return $this;
    }
}