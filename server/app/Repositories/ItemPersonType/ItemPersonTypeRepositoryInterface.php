<?php

namespace App\Repositories\ItemPersonType;

use App\Repositories\RepositoryInterface;

/**
 * The repository interface for the Brand Model
 */
interface ItemPersonTypeRepositoryInterface extends RepositoryInterface
{
    /**
     * Find the person type by code
     *
     * @param string $code
     * @return collection
     */
    public function findByCode($code);
}
