<?php

namespace App\Repositories\Address;

use App\Repositories\RepositoryInterface;

interface AddressRepositoryInterface extends RepositoryInterface
{
    /**
     *Set current address as default
     * @param  $model
     */
    public function setAsDefault($model);
}
